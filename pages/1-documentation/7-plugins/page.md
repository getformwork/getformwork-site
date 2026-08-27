---
title: "Plugins"
description: "Understand Formwork plugin architecture and learn how to build plugins with routes, services, views, assets, schemes, and event listeners."
prevNext: true
---

Since Formwork 2.3.0, plugins are the go-to layer for extending the CMS with custom features.

Plugins are loaded from `📂 site/plugins/` and initialized during application boot. A plugin can add routes, event listeners, translations, views, assets, schemes, configuration defaults, and custom services.

Each plugin is a self-contained module that can be enabled, configured, and evolved independently from the core codebase. Plugins don't need to define full-fledged services: they can be as small as a class that only listens to one or more events.

Common plugin use cases include:

- Listening to Formwork lifecycle/page/panel events
- Adding custom routes and controllers
- Providing plugin settings through schemes and Panel options
- Shipping reusable views, assets, and translations
- Integrating external APIs or internal shared logic

## Plugins in Formwork lifecycle

When Formwork starts, plugins are discovered and initialized as part of the normal application boot process.

Understanding this flow helps you decide where to put logic in your plugin: the lifecycle order tells you **when** the code runs, and plugin folder structure tells you **where** Formwork expects files such as routes, views, assets, and schemes.

### Lifecycle details

During boot, Formwork processes plugins in this order:

1. Load app services
2. Load plugin directories from `system.plugins.path` (default: `📂 site/plugins`)
3. Initialize **enabled** plugins
    1. Instantiate the main plugin class (extending `Formwork\Plugins\Plugin`)
    2. Run the plugin `autoload()` method (if provided) to register plugin classes and dependencies with a Composer autoloader
    3. Register event listeners defined by methods starting with `on...`
    4. Execute the `initialize()` method internally, which is responsible for:
        - loading default config from `plugin.yaml`
        - loading schemes from `📂 schemes/` (if provided)
        - loading translations from `📂 translations/` (if provided)
        - registering views from `📂 views/` (if provided)
        - registering assets from `📂 assets/` (if provided)
        - calling `loadServices()` to register plugin services in the container (if overridden)
4. Load panel and system routes

This order matters. For example, event listeners are discovered before plugin internals are loaded, while plugin services are available after initialization.

### Plugin folder structure

A plugin is contained in a folder under `📂 site/plugins/`. The folder name is used as the plugin ID.

> [!NOTE]
> The plugin ID is used in config keys, translation keys, view namespaces, and asset namespaces. It must be unique and must be composed of only lowercase letters, numbers, and hyphens. For example, `hello-world` is valid, while `hello_world` or `helloWorld` are not.

The typical folder structure is:

| Path                               | Description                                                       | Required |
| ---------------------------------- | ----------------------------------------------------------------- | -------- |
| `📂 <plugin-id>/plugin.yaml`       | Plugin manifest (metadata and optional default config)            | No       |
| `📂 <plugin-id>/<plugin-id>.php`   | Main plugin class extending `Formwork\Plugins\Plugin`             | Yes      |
| `📂 <plugin-id>/src/`              | PHP classes (controllers, listeners helpers, services)            | No       |
| `📂 <plugin-id>/routes/routes.php` | Plugin route definitions, to add endpoints for controller actions | No       |
| `📂 <plugin-id>/views/`            | Plugin view files resolved as `@plugin:<id>.*`                    | No       |
| `📂 <plugin-id>/assets/`           | Static files (CSS, JS, images) resolved via plugin assets         | No       |
| `📂 <plugin-id>/translations/`     | Translation dictionaries (`en.yaml`, `it.yaml`, etc.)             | No       |
| `📂 <plugin-id>/schemes/`          | Scheme files, including plugin options UI schemes                 | No       |
| `📂 <plugin-id>/vendor/`           | Composer dependencies and autoloader                              | No       |

> [!NOTE]
> Only `plugin.yaml` and the main plugin class file are required for a valid plugin package.

### Enabling plugins

Plugins are enabled by setting the `enabled` flag to `true`. This can be done at two levels:

- Global switch: `system.plugins.enabled`
- Per-plugin flag: `plugins.<pluginName>.enabled`

The global switch is a master toggle that can disable all plugins at once. The per-plugin flag allows you to enable or disable individual plugins while keeping them installed.

## Plugin manifest

The `plugin.yaml` file is the plugin manifest. The manifest contains metadata about the plugin and can also define default configuration values.

The manifest can include the following keys:

| Key           | Description                                             |
| ------------- | ------------------------------------------------------- |
| `title`       | Human-readable plugin name shown in the Panel and docs. |
| `description` | Short summary of what the plugin does.                  |
| `author`      | Author or organization name.                            |
| `homepage`    | Project URL (docs, repository, or marketing page).      |
| `license`     | License identifier (for example `MIT`).                 |
| `version`     | Plugin version string.                                  |
| `config`      | Default configuration values.                           |

Example:

```yaml
title: Hello World
description: A plugin that greets the world
author: Your Name
homepage: https://example.com
license: MIT
version: 1.0.0

config:
    greeting: Hello, World!
```

Values in `config` are used as defaults when the plugin is enabled. They can be overridden by writing YAML files under `📂 site/config/plugins/` or by setting options in the Panel.

## Plugin entrypoint

Plugins must have a main class (or entrypoint) that extends `Formwork\Plugins\Plugin`. This class is responsible for defining plugin behavior, such as event listeners, services, and autoloading.

For a plugin with ID `hello-world`, Formwork infers the main class file and class name using a convention.

- Main class file: `hello-world.php`
- Main class name: `Formwork\Plugins\HelloWorldPlugin` (uppercase first letter of each word, no hyphens, suffixed with `Plugin`)
- Plugin config key: `plugins.helloWorld`

> [!WARNING]
> If the class file or class name does not match this convention, the plugin is considered invalid and is ignored during loading.

The minimal main plugin class for the `hello-world` plugin looks like this:

```php
📄 site/plugins/hello-world/hello-world.php

<?php

namespace Formwork\Plugins;

class HelloWorldPlugin extends Plugin
{

}
```

With this code alone, Formwork can discover and load the plugin along with the provided views, assets, and translations, but it won't do much until you add functionality such as event listeners, routes, or services or additional classes and dependencies.

Read the sections below to learn how to add features to your plugin and make it do something useful.

## Plugin configuration

Plugin configuration is loaded under the `plugins` namespace from `📂 site/config/plugins/*.yaml`. For our plugin with ID `hello-world`, the options are stored in `📂 site/config/plugins/hello-world.yaml`.

In code, plugin options are available from the config as `plugins.helloWorld.*`.

Example:

```php
$greeting = $this->app->config()->get('plugins.helloWorld.greeting'); // Hello, World!
```

## Event listeners

Plugins can listen to Formwork events by defining **public** methods prefixed with `on`.

Formwork automatically maps method names to event names, stripping the `on` prefix and converting the remaining name to lower camel case. For example:

| Method name                                                                                             | Event name         | Event class                                                                                         |
| ------------------------------------------------------------------------------------------------------- | ------------------ | --------------------------------------------------------------------------------------------------- |
| <code><span class="type-name">onPageRender</span><span class="token punctuation">()</span></code>       | `pageRender`       | [`Formwork\Pages\Events\PageRenderEvent`{.type-name}](/reference/events/pagerenderevent/)           |
| <code><span class="type-name">onPanelLoggedIn</span><span class="token punctuation">()</span></code>    | `panelLoggedIn`    | [`Formwork\Panel\Events\PanelLoggedInEvent`{.type-name}](/reference/events/panelloggedinevent/)     |
| <code><span class="type-name">onRoutesBeforeLoad</span><span class="token punctuation">()</span></code> | `routesBeforeLoad` | [`Formwork\Cms\Events\RoutesBeforeLoadEvent`{.type-name}](/reference/events/routesbeforeloadevent/) |

> [!NOTE]
> This naming convention keeps event wiring inside the plugin class with no manual registration code.

The complete list of events is available in the [API reference](/reference/events/), but you can also listen to custom events dispatched by other plugins or your own code.

For example, in the Hello World plugin, you can listen on the `pageRender` event to modify the variables passed to the page template to include a greeting message:

```php
public function onRoutesBeforeLoad(RoutesBeforeLoadEvent $event): void
{
    $greeting = $this->app->config()->get('plugins.helloWorld.greeting');
    $event->vars()['message'] = "The plugin says: {$greeting}"; // The plugin says: Hello, World!
}
```

Then the `$message` variable is available in page templates:

```php
<p class="greeting"><?= $this->escape($message) ?></p>
```

### Listener methods rules

- Method must be `public`
- Method name must start with `on`
- Event name is inferred from the remaining method name, converted to lower camel case

> [!NOTE]
> If a method is not public or does not start with `on`, it is not treated as an event listener.

## Dependencies and classes autoloader

Plugins often need to define additional classes (for example controllers, services, or event listeners) and manage dependencies. To make these classes available to Formwork, you can override the `autoload()` method in your plugin class.

The `autoload()` method returns a [Composer](https://getcomposer.org/) instance that can autoload plugin classes. This is typically done by including a Composer autoloader from the plugin's `vendor` directory, but you can also build and return a custom `ClassLoader` if needed.

For example our Hello World plugins needs a (fictional) dependency named `acme/greeter` to generate greetings.

First we install the dependency in the plugin folder:

```shell
cd site/plugins/hello-world
composer require acme/greeter
```

This creates the `vendor` folder with the dependency and an autoloader.

Then we override the `autoload()` method to make the dependency available:

```php
use Composer\Autoload\ClassLoader;
use Formwork\Plugins\Plugin;

class HelloWorldPlugin extends Plugin
{
    public function autoload(): ?ClassLoader
    {
        $autoloader = require __DIR__ . '/vendor/autoload.php';
        return $autoloader;
    }

    // ...other plugin methods...
}
```

Then we also want to define additional classes for our plugin, for example a class `Formwork\Plugins\HelloWorld\FancyGreeter`{.type-name}. We can place it in `📂 site/plugins/hello-world/src/` and register a [PSR-4](https://www.php-fig.org/psr/psr-4/) namespace in the `autoload()` method.

```php
public function autoload(): ?ClassLoader
{
    $autoloader = require __DIR__ . '/vendor/autoload.php';
    $autoloader->addPsr4('Formwork\\Plugins\\HelloWorld\\', __DIR__ . '/src/');
    return $autoloader;
}
```

> [!NOTE]
> As seen in the example, including `vendor/autoload.php` already returns a `ClassLoader` instance, so in practice you only need to create a `ClassLoader` only if you don't need other dependencies or if you want to customize the autoloading behavior (not recommended).

## Controllers

Plugins can define controllers to handle requests for custom routes. Controllers are just PHP classes that return a `Formwork\Http\Response` object from their methods.

The recommended setup is to place controllers in `📂 site/plugins/<plugin-id>/src/` and reference them from plugin routes described in the next section.

```php
namespace Formwork\Plugins\HelloWorld;

use Formwork\Controllers\AbstractController;
use Formwork\Http\Response;

class HelloWorldController extends AbstractController
{
    public function greet(): Response
    {
        return new Response('Hello, World!');
    }
}
```

> [!TIP]
> Controller methods can receive dependencies (for example `RouteParams`, `Site`, `Panel`, or custom services) through the container via method parameters. These dependencies are resolved automatically when the controller action is called, so you can focus on writing the logic for handling the request and generating the response.
>
> For example your controller action needs to access the `Logger` service, you can just add it as a parameter and Formwork will inject it when the method is called:
>
> ```php
> public function greet(Formwork\Log\Logger $logger): Response
> {
>     $logger->info('Greeting the world, now!');
>     return new Response('Hello, World!');
> }
> ```

## Routes

Routes are not auto-loaded from plugin folders by default but you can use the `routesBeforeLoad` event to add your route definitions.

The common pattern is to place route definitions in a the file `site/plugins/<plugin-id>/routes/routes.php` and then load them in the `onRoutesBeforeLoad` listener method. This keeps route definitions separate from the main plugin class and allows you to organize them as needed.

`routes.php` returns an array of route definitions under the `routes` key. Each route definition has a name (its key), a `path`, and an `action` (controller method) to execute when the route is accessed.

For example in our Hello World plugin, we want to add a route that points to the `greet` action of our `HelloWorldController`:

```php
📄 site/plugins/hello-world/routes/routes.php

<?php

use Formwork\Plugins\HelloWorld\HelloWorldController;

return [
    'routes' => [
        'plugins.helloWorld.greet' => [ // Route name, used for URL generation
            'path'   => '/greet/', // Route path
            'action' => HelloWorldController::class . '@greet', // Controller action
        ],
    ],
];
```

> [!TIP]
> It's recommended to prefix plugin route names with `plugins.<pluginName>.`

Then in the plugin entrypoint, we listen to the `routesBeforeLoad` event and load the route file:

```php
📄 site/plugins/hello-world/hello-world.php

<?php
use Formwork\Cms\Events\RoutesBeforeLoadEvent;
use Formwork\Utils\FileSystem;

class HelloWorldPlugin extends Plugin
{
    public function onRoutesBeforeLoad(RoutesBeforeLoadEvent $event): void
    {
        // The RoutesBeforeLoadEvent exposes the router via $event->router()
        $event->router()->loadFromFile(FileSystem::joinPaths($this->path(), 'routes/routes.php'));
    }
}
```

If your controller actions need plugin context (for example to access plugin services or config), you can also pass `actionParameters` when loading the routes:

```php
📄 site/plugins/hello-world/hello-world.php

<?php

class HelloWorldPlugin extends Plugin
{
    public function onRoutesBeforeLoad(RoutesBeforeLoadEvent $event): void
    {
        $event->router()->loadFromFile(
            FileSystem::joinPaths($this->path(), 'routes/routes.php'),
            actionParameters: ['plugin' => $this]
        );
    }
}
```

Then the `plugin` parameter is available in controller actions:

```php
📄 site/plugins/hello-world/src/HelloWorldController.php

class HelloWorldController extends AbstractController
{
    public function greet(Formwork\Plugins\Plugin $plugin): Response
    {
        // Greetings from Hello World!
        return new Response("Greetings from {$plugin->manifest()->name()}!");
    }
}
```

> [!TIP]
>
> - Keep controller actions small and delegate work to services
> - Pass `actionParameters` if your controller needs plugin context

## Views and assets

If present, plugin directories are registered automatically:

- `📂 site/plugins/<plugin-id>/views/` as view namespace `@plugin:<plugin-id>`
- `📂 site/plugins/<plugin-id>/assets/` as asset namespace `@plugin:<plugin-id>`

Examples:

```php
// Render a plugin view
$this->view('@plugin:hello-world.greeting');

// Get a plugin asset URI
$this->assets()->get('@plugin:hello-world/css/plugin.css')->uri();
```

> [!TIP]
> Formwork also auto-registers an assets route for plugins, so you can access plugin assets directly from the URL `/assets/plugins/<plugin-id>/<asset-path>` without additional configurations. For example, the CSS file above is available at `/assets/plugins/hello-world/css/plugin.css`.

### Rendering views

You can render plugin views from controllers by referencing them with the `@plugin:<plugin-id>` namespace.

For example, if you have a view file at `📂 site/plugins/hello-world/views/greeting.php`, you can render it from a controller action like this:

```php
class HelloWorldController extends AbstractController
{
    public function greet(Formwork\Cms\Site $site): Response
    {
        return new Response($this->view('@plugin:hello-world.greeting', [
            // Variables passed to the view
            'title' => 'Greetings',
            'name'  => $site->users()->loggedIn()->fullname(),
        ]));
    }
}
```

### Using assets

To include plugin assets in your views, use the `assets()` helper with the `@plugin:<plugin-id>` namespace.

For example, to include a CSS file located at `📂 site/plugins/hello-world/assets/css/plugin.css`, you can get its URI like this:

```php
<?= $this->assets()->get('@plugin:hello-world/css/plugin.css')->uri(includeVersion: true) ?>
```

The `includeVersion` option appends a version query parameter to the asset URL based on the file's last modified time, which is useful for cache busting in production.

> [!TIP]
> Use versioned URLs for long-lived caching when distributing plugin assets in production.

## Schemes

You can also use the schemes under `📂 site/plugins/<plugin-id>/schemes/` and to extend page/user/config models as needed.

For example, if you want to add a `Hello World` tab to the pages, you can listen the `pluginsInitialized` event and extend the page scheme with a new section and fields:

```php
use Formwork\Plugins\Events\PluginsInitializedEvent;
use Formwork\Plugins\Plugin;

class HelloWorldPlugin extends Plugin
{
    public function onPluginsInitialized(PluginsInitializedEvent $event): void
    {
        $pageScheme = $this->app->schemes()->get('pages');

        // Load a scheme defined by the plugin
        $greetingsScheme = $this->app->schemes()->get('hello-world-greetings');

        $pageScheme->extend($greetingsScheme);
    }
}
```

### Plugin options scheme

If your plugin defines a scheme at: `📂 schemes/plugins/<plugin-id>.yaml`

Formwork can use it to render a plugin options form in the Panel.

Example plugin options scheme:

```yaml
title: Hello World

layout:
    type: sections
    sections:
        general:
            label: General
            fields: [greeting]

fields:
    greeting:
        type: text
        label: Greeting message
```

> [!NOTE]
> The Panel looks for plugin options using the scheme id `plugins.<plugin-id>` and can load it from `📂 schemes/plugins/<plugin-id>.yaml`.

## Translations

Translations defined in `📂 site/plugins/<plugin-id>/translations/` are loaded automatically.

For example:

```yaml
plugin.helloWorld.title: Hello World
plugin.helloWorld.description: Adds hello world features
```

You can then reference translation keys in schemes and views:

```yaml
title: "{{plugin.helloWorld.title}}"
```

## Services

To expose services override `loadServices(Container $container)`.

```php
use Formwork\Services\Container;

protected function loadServices(Container $container): void
{
    $container->define(MyService::class, $container->build(MyService::class));
}
```

This is useful when controllers, templates, or other services need shared plugin functionality.

## Checklist

To create a new plugin:

1. Create folder `📂 site/plugins/<plugin-id>/`
2. Add `<plugin-id>.php` with a class extending `Formwork\Plugins\Plugin`
3. Add `plugin.yaml` with metadata (and optional defaults in `config`)
4. Add optional folders (`src`, `routes`, `views`, `assets`, `translations`, `schemes`) as needed
5. Enable the plugin from Panel (or set `enabled: true` in `site/config/plugins/<plugin-id>.yaml`)

> [!TIP]
> Keep plugin code self-contained in `📂 site/plugins/<plugin-id>/` and avoid modifying core files. This makes updates safer and plugin behavior easier to maintain.
