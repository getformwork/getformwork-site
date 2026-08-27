---
title: "Site options"
description: "Manage global site-specific settings stored in `config/site.yaml`, including metadata, languages, and statistics."
prevNext: true
---

The **site configuration** file defines options specific to your website, including metadata, language support, route aliases, and statistics tracking. These settings are defined in the file `site/config/site.yaml` and defaults are loaded from `formwork/config/site.yaml`.

Just like system configuration, only values that differ from the defaults are stored in `site/config/site.yaml`.

Both the system and site configuration are cached as PHP for performance.

## General settings

Defines the site's author, default template, base path, and metadata. These values help control how the site is rendered and identified.

> [!NOTE]
> These options have no specific section.

| Option            | Type                   | Description                                                 | Default               |
| ----------------- | ---------------------- | ----------------------------------------------------------- | --------------------- |
| `author`          | `string`{.type-string} | The default author name used in templates or metadata       | `''`                  |
| `defaultTemplate` | `string`{.type-string} | The fallback template used for new pages when not specified | `page`                |
| `description`     | `string`{.type-string} | Optional site description, usable in metadata or templates  | `''`                  |
| `path`            | `string`{.type-string} | Filesystem path to the `📂 site` directory                  | `${%ROOT_PATH%}/site` |
| `routeAliases`    | `array`{.type-keyword} | Array of custom route aliases (e.g., `about-us: about`)     | `[]`                  |
| `metadata`        | `array`{.type-keyword} | List of global metadata entries (e.g., meta tags)           | `[]`                  |

## Language support

Enables multilingual functionality. You can define available languages and let the system detect a user's preferred language via their browser.

| Option                    | Type                   | Description                                             | Default |
| ------------------------- | ---------------------- | ------------------------------------------------------- | ------- |
| `languages.available`     | `array`{.type-keyword} | List of supported language codes (e.g., `['en', 'it']`) | `[]`    |
| `languages.httpPreferred` | `bool`{.type-bool}     | Enable automatic language detection via HTTP headers    | `false` |

## Taxonomies {.is-new}

**Since 2.2.0**{.badge .badge-yellow}

Defines site-wide taxonomies like tags and categories that can be used to organize and classify content.
| Option | Type | Description | Default |
|--------|------|-------------|---------|
| `taxonomies` | `array`{.type-keyword} | List of taxonomy names to enable (e.g., `['tags', 'categories']`) | `[]` |

### Using taxonomies

To use taxonomies in your page schemes, enable the [`allowTaxonomy` option](../page-schemes/#options-section) in the desired schemes. This will make the taxonomy routes reachable for those page types.

To display taxonomy terms and associated pages on the frontend, you need to implement the necessary logic in your templates by defining a controller.

For example, you have a `blog` content model and you want to use `tags` as taxonomy. First, enable `tags` in the site options:

```yaml
taxonomies: ["tags"]
```

Then, in the `blog` page scheme, enable the `allowTaxonomy` option:

```yaml
options:
    allowTaxonomy: true
```

Finally, create a `blog.php` [template controller](../templates/#template-controllers) in the `📁 site/controllers` directory to handle displaying posts by tag from the `{taxonomy}` and `{taxonomyTerm}` route parameters:

```php
// Posts are the published children of the blog page
$posts = $page->children()->published();

// If the route has the param `{taxonomy}`
if ($router->params()->has('taxonomy')) {
    // Filter posts by the taxonomy term provided in the `{taxonomyTerm}` param
    $posts = $posts->havingTaxonomy(
        [$router->params()->get('taxonomy') => [$router->params()->get('taxonomyTerm')]],
        slug: true // Use slugs for matching terms
    );
}

return ['posts' => $posts];
```

This controller retrieves the published child pages of the `blog` page, filters them based on the taxonomy term provided in the route parameters, and passes the filtered collection to the template as the `$posts` variable.

> [!NOTE]
> Use the `slug: true` argument in `havingTaxonomy()` to match terms by their slugs and not the term itself. This takes into account that taxonomy terms can have spaces or special characters.
> It is recommended to always use slugs for matching terms from route parameters like in the example above.

In the template, you can then loop through the filtered `$posts` collection. For example:

```php
<?php foreach ($posts as $post): ?>
    <h2><a href="<?= $post->uri() ?>"><?= $post->title() ?></a></h2>
    <p><?= $post->summary() ?></p>
<?php endforeach ?>
```

> [!TIP]
> The `havingTaxonomy()` method can be used on any `PageCollection` to filter pages based on assigned taxonomy terms. It accepts also multiple taxonomies at once. For example, to get pages tagged (with the `tag` taxonomy) with either `recipes` or `travel` and categorized (`category` taxonomy) under `food`:
>
> ```php
> $pages->havingTaxonomy([
>     'tags'       => ['recipes', 'travel'],
>     'categories' => ['food'],
> ]);
> ```

## Maintenance mode

Lets you temporarily disable your public site and show a custom maintenance page to visitors while preserving access for administrators and panel users.

| Option                | Type                                       | Description                                 | Default |
| --------------------- | ------------------------------------------ | ------------------------------------------- | ------- |
| `maintenance.enabled` | `bool`{.type-bool}                         | Enable or disable maintenance mode globally | `false` |
| `maintenance.page`    | `string`{.type-string}\|`null`{.type-null} | Optional page to show during maintenance    | `null`  |

## Statistics tracking

Controls built-in analytics features like visit tracking, unique visitors, referrers, and devices. Useful for understanding user behavior directly from Formwork without third-party tools.

| Option                               | Type                   | Description                                                                 | Default                   |
| ------------------------------------ | ---------------------- | --------------------------------------------------------------------------- | ------------------------- |
| `statistics.enabled`                 | `bool`{.type-bool}     | Enable visitor statistics tracking                                          | `true`                    |
| `statistics.trackLocalhost`          | `bool`{.type-bool}     | Track visits from localhost (useful for testing)                            | `false`                   |
| `statistics.visitsDelay`             | `int`{.type-number}    | Time in seconds to consider a session as a new visit                        | `15`                      |
| `statistics.path`                    | `string`{.type-string} | Path to store statistics registry files                                     | `${site.path}/statistics` |
| `statistics.registries.sessions`     | `string`{.type-string} | Filename for session data                                                   | `sessions.json`           |
| `statistics.registries.visits`       | `string`{.type-string} | Filename for visits data                                                    | `visits.json`             |
| `statistics.registries.uniqueVisits` | `string`{.type-string} | Filename for unique visit data                                              | `uniqueVisits.json`       |
| `statistics.registries.visitors`     | `string`{.type-string} | Filename for visitor data                                                   | `visitors.json`           |
| `statistics.registries.pageViews`    | `string`{.type-string} | Filename for page views data                                                | `pageViews.json`          |
| `statistics.registries.sources`      | `string`{.type-string} | Filename for source/referrer data                                           | `sources.json`            |
| `statistics.registries.devices`      | `string`{.type-string} | Filename for device type data                                               | `devices.json`            |
| `statistics.cleanup.ttl`             | `int`{.type-number}    | Time-to-live (in seconds) before data is cleaned up                         | `86400`                   |
| `statistics.cleanup.probability`     | `int`{.type-number}    | Probability (%) that sessions and visitor data cleanup runs on each request | `5`                       |
