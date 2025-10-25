---
title: Templates
prevNext: true
description: 'Learn how templates control the visual rendering of pages and how to organize layouts, partials, and reusable blocks in your theme.'
---
## Introduction
Templates in Formwork define how your pages are rendered on the frontend. They are PHP files located in your site's `📂 templates/` directory and are directly associated with the page's content file name.

Each template is responsible for generating the HTML output for a specific type of page, such as a homepage, a blog listing, or a single post.

## Template files
Templates are regular PHP files and are located in `📂 site/templates/`.

Each file corresponds to a template name. For example:

* `default.php` is used by pages with content file `default.md`
* `blog.php` is used by pages with `blog.md`
* `post.php` is used by pages with `post.md`

> [!NOTE]
> In template names the scheme type is omitted. For example the template corresponding to the scheme `pages.product` is `product.php`, not `pages.product.php`.

## Using PHP in templates

Formwork templates are **PHP files**. This means you can use PHP syntax to create conditional logic, iterate over collections, render dynamic content, and build custom layout structures directly inside your template files.

PHP code is placed between the `<?php` and `?>` tags and can include control structures like `if`, `foreach`, and `switch`, and any other valid PHP code:

```php
<?php if ($page->has('coverImage')): ?>
    This text will be shown if the page has a cover image.
<?php endif ?>
```

### Outputting values

To **output** values, you can use the short echo tag `<?=`:

```php
<?= $variable ?>
```

This is equivalent to `<?php echo $variable ?>` and is the preferred syntax for cleaner and more readable templates:

```php
<h1><?= $page->title() ?></h1>
<p><?= $page->content() ?></p>
```

You can also safely combine HTML and PHP without closing and reopening PHP tags unless needed for logic or loops.

### Common control structures

Formwork templates support standard PHP control structures, allowing you to control what content is shown and how it is displayed dynamically.

#### Conditionals

Use conditional statements like `if`, `else`, and `elseif` to selectively render parts of the page based on certain conditions. This is helpful when you want to show content only if a field exists, a page is listed, or any other logical test passes.

```php
<?php if ($page->listed()): ?>
    <span class="status">Listed</span>
<?php else: ?>
    <span class="status">Hidden</span>
<?php endif ?>
```

#### Loops

Use loops, such as `foreach`, to iterate over collections of items like a page's children, a list of files, or metadata entries. This is especially useful for building menus, blog indexes, or galleries dynamically based on your content.

```php
<ul>
<?php foreach ($page->children()->listed() as $child): ?>
    <li><a href="<?= $child->uri() ?>"><?= $child->title() ?></a></li>
<?php endforeach ?>
</ul>
```

### Embedding HTML and PHP code together

You can freely mix HTML and PHP in your templates. It's best practice to avoid switching between PHP and HTML unnecessarily. Keep PHP logic minimal and readable:

```php
<?php if ($page->has('coverImage')): ?>
    <img class="cover-image" src="<?= $page->coverImage()->uri() ?>">
<?php endif ?>
```

> [!TIP]
> Some **best practices** for writing clean and maintainable templates include:
>
> - Use **short echo tags** `<?=` for outputting values
> - Use the **[alternative syntax for control structures](https://www.php.net/manual/en/control-structures.alternative-syntax.php)** to avoid braces (`{` and `}`) in the template
> - Use spacing and indentation consistently to improve readability.
> - Keep templates **focused on presentation**, and avoid excessive data manipulation in them. For complex logic use controllers, helper methods or reusable partials when appropriate.

## Default variables

When a template is rendered, Formwork provides several <strong>default global variables</strong> that you can use within your template. These variables give you access to the current page, site, and application context, as well as utility functions and CSRF tokens for form handling.

|Variable|Type|Description|
|--|--|--|
|`$this`|<code><span class="type-name">Formwork\Templates\Template</span></code>|The current template. It is mainly used to access methods to include partial templates, define blocks, declare layout, access utility functions, etc. See [API reference](../../reference/api/template/) for available methods. The object is extended with [template methods](../../reference/template-methods/)|
|`$page`|<code><span class="type-name">Formwork\Page\Page</span></code>|The current page. See [API reference](../../reference/api/page/) for available methods|
|`$site`|<code><span class="type-name">Formwork\Cms\Site</span></code>|The site. See [API reference](../../reference/api/site/) for available methods|
|`$app`|<code><span class="type-name">Formwork\Cms\App</span></code>|The global CMS instance. See [API reference](../../reference/api/app/) for available methods|
|`$router`|<code><span class="type-name">Formwork\Router\Router</span></code>|The router instance. Useful for reading route params and generating routes. See [API reference](../../reference/api/router/) for available methods|
|`$crsfToken`|<code><span class="type-name">Formwork\Security\CsrfToken</span></code>|The CSRF token instance, useful when handling form data|

## Rendering pages

### The `$page` variable
When rendering a page, Formwork provides a `$page` variable that contains all the data related to the current page.

This object is an instance of <code><span class="type-name">Formwork\Pages\Page</span></code> (see [API Reference](/reference/api/site/)) and provides methods to access various properties and fields of the page.

* Content (`$page->content()`)
* Frontmatter fields (e.g. `title`, `published`)
* Children pages (`$page->children()`)

Example:

```php
<h1><?= $page->title() ?></h1>
<p><?= $page->content() ?></p>

<?php foreach ($page->children()->listed() as $child): ?>
    <article>
        <h2><a href="<?= $child->uri() ?>"><?= $this->escape($child->title()) ?></a></h2>
        <p><?= $child->summary() ?></p>
    </article>
<?php endforeach ?>
```

### Accessing fields
You can access fields defined in the page's frontmatter directly as methods of the `$page` object. For example, you can get the value of the field `title` with `$page->title()`:

```php
<header class="page-header">
    <h1 class="page-title"><?= $page->title() ?></h1>
</header>
```

You can also access fields defined in the page's content file, such as `summary`, `coverImage`, or any custom field you have defined in your content file.

> [!NOTE]
> In pages, and content models in general, Formwork uses this **resolution algorithm** when calling a method:
>
> 1. Check if there is a **method** defined in the page object or in its class ancestors.
>    For example: `$page->images()`, `$page->parent()` will call directly the corresponding methods defined in the class `Formwork\Pages\Page`.
> 2. If the method is not found, check if there is a **property** defined with the same name.
> 3. If the property is not found, check if there is a **field** defined with the same name.
> 4. If the field is found, check if there is a key in the page **data** with the same name (e.g. a value you defined in the page frontmatter, without a corresponding field defined in the page scheme).
> 5. If the field is not found, a `BadMethodCallException` is thrown.
>
> It is worth noting that this algorithm applied to content models may have some unwanted **_shadowing_ side effects**.
>
> For example, if your define a field named `media` it won't be accessible with `$page->media()`, because the `Formwork\Pages\Page` class already defines a [`media()` method](../../reference/api/page/#page-media) that _shadows_ the user-defined field.
>
> In such cases you may access the field with `$page->fields()->get('media')` but you should avoid this naming to begin with.

#### Conditional field access
You can check if a field exists or has a value using the `$page->has()` method. For example, to check if the page has a `coverImage` field:
```php
<?php if ($page->has('coverImage')): ?>
...
<?php endif ?>
```

There is also a `$page->get()` method that returns the value of a field, or `null` if the field does not exist.
This is useful when you want to access a field that may not be defined, and you want to avoid errors.

```php
<p class="author">Author: <?= $page->get('author') ?></p>
```

If the `author` field does not exist, it will simply output nothing.

You can also provide a default value as the second argument to `get()`:
```php
<p class="author">Author: <?= $page->get('author', 'Unknown author') ?></p>
```
This will output "Unknown author" if the `author` field does not exist.

#### Field methods
Fields can have methods that return specific values or formats. For example, if you have `publishDate` field of type `date` you have access to the method `format()` to control the output format.

```php
<p class="date"><?= $page->publishDate()->format('YYYY-MM-DD hh:mm') ?></p>
```

This will output the publish date like "2025-07-05 15:48".

You can instead use the `toDuration()` method to get a localized duration string:
```php
<p class="duration"><?= $page->publishDate()->toDuration() ?></p>
```
This will output a string like "2 months ago" or "in 3 days" depending on the current date and the publish date.

Of course, you can also directly access the field. In this case, the field of type `date` uses a default format of `YYYY-MM-DD`.
```php
<p class="duration"><?= $page->publishDate() ?></p>
```

You can find the available methods for each type in the [Fields](/reference/fields/) reference.

### Traversing the page tree
You can traverse the page tree using the `$page` variable. These methods return either a single `Page` or `Site` object, or a collection of pages represented by the class <code><span class="type-name">Formwork\Pages\PageCollection</span></code>, depending on the method used.

#### Children and descendants
To access the children of the current page, you can use the `$page->children()` method, which returns a collection of child pages. You can also use the `$page->descendants()` method to get all descendants of the current page, including children, grandchildren, and so on.
```php
<?php foreach ($page->children() as $child): ?>
    <a href="<?= $child->uri() ?>"><?= $this->escape($child->title()) ?></a>
<?php endforeach ?>
```
```php
<?php foreach ($page->descendants() as $descendant): ?>
    <a href="<?= $descendant->uri() ?>"><?= $this->escape($descendant->title()) ?></a>
<?php endforeach ?>
```

#### Parent and ancestors
To access the parent page or the ancestors of the current page, you can use the `$page->parent()` method or the `$page->ancestors()` method, respectively.
```php
<?= $this->escape($page->parent()->title()) ?>
```
```php
<?php foreach ($page->ancestors() as $ancestor): ?>
    <a href="<?= $ancestor->uri() ?>"><?= $this->escape($ancestor->title()) ?></a>
<?php endforeach ?>
```

> [!NOTE]
> For top-level pages, the parent will be the `$site` object, which is an instance of <code><span class="type-name">Formwork\Cms\Site</span></code>.
> The `$site` object is the root of the page tree, and returns <code><span class="type-null">null</span></code> when you call `$site->parent()`.

If you need to check whether `$parent` is a site or a page, you can use the `$parent->isSite()` method:

```php
<?php if ($page->parent()->isSite()): ?>
    <p>This is a top-level page.</p>
<?php else: ?>
    <p>This is a child page.</p>
<?php endif ?>
```

#### Siblings
To access the siblings of the current page, you can use the `$page->siblings()` method, which returns a collection of sibling pages. You can also use the `$page->nextSibling()` and `$page->previousSibling()` methods to get the next and previous sibling pages, respectively.
```php
<?php foreach ($page->siblings() as $sibling): ?>
    <a href="<?= $sibling->uri() ?>"><?= $sibling->title() ?></a>
<?php endforeach ?>
```
```php
<?php if ($page->previous()): ?>
    <p>Go to the previous page: <a href="<?= $page->previousSibling()->uri() ?>"><?= $page->previousSibling()->title() ?></a></p>
<?php endif ?>
<?php if ($page->next()): ?>
    <p>Go to the next page: <a href="<?= $page->nextSibling()->uri() ?>"><?= $page->nextSibling()->title() ?></a></p>
<?php endif ?>
```
If you need a collection with the siblings *and* the current page, you can use the `$page->inclusiveSiblings()` method and use the `$page->isCurrent()` to check if the page is the current one:

```php
<ol>
<?php foreach ($page->inclusiveSiblings() as $sibling): ?>
    <?php if ($sibling->isCurrent()): ?>
        <li class="active"><?= $sibling->title() ?></li>
    <?php else: ?>
        <li><a href="<?= $sibling->uri() ?>"><?= $sibling->title() ?></a></li>
    <?php endif ?>
<?php endforeach ?>
</ol>
```

#### Filtering page collections
In Formwork, collections are powerful objects that allow you to filter, sort, and manipulate their items easily.

In particular, in `PageCollection` objects you can use methods like `listed()`, `published()`, `allowingChildren()`, etc.

These methods return a new `PageCollection` object that contains only the pages that match the specified criteria. You can chain these methods together to create complex queries.

Here are some examples of how to filter collections:

```php
<?php foreach ($site->descendants()->published()->listed() as $descendant): ?>
    <!-- Do something with all published, listed site descendants  -->
<?php endforeach ?>
```

You can use the `filterBy()` method to filter pages based on a custom condition.

This method accepts one or two argument:

* The first argument is a field that has to be present to include the page in the collection.
* The second argument is an optional value to match against the field. If not provided it is `true`, meaning the collection will include all pages that have the field and does not return `null` or another *falsy* value (e.g. `false`, `0`, `''`).

For example, you want to filter the pages that have "The Mysterious Magician" as `author`:

```php
<?php foreach ($site->descendants()->filterBy('author', 'The Mysterious Magician') as $page): ?>
    <!-- Do something with all pages that have "The Mysterious Magician" as author -->
<?php endforeach ?>
```

> [!TIP]
> You can use a closure to specify advanced filters:
> ```php
> <?php foreach ($site->descendants()->filterBy('amountOfMagic', fn($value) => $value >= 100) as $page): ?>
>     <!-- Do something with all pages that have an amount of magic greater than or equal to 100 -->
> <?php endforeach ?>
> ```
> In this example, the closure receives the value of the `amountOfMagic` field and returns `true` if the value is greater than or equal to 100, thus including the page in the collection.

## Layout, partials, and blocks
Formwork templates support a flexible system of **layout**, **partials**, and **blocks** to help you organize templates and reuse code across different pages.

### The `$this` variable

The `$this` variable in Formwork templates returns the instance of the underlying <code><span class="type-name">Formwork\Views\View</span></code> class, which is used to render the template.

It provides a set of methods and properties that help you manage the template rendering process, including including partials, defining blocks, and accessing utility functions.

### Setting the layout
Your site usually has a common **layout**, which includes a **header**, **footer**, and a **content** area. Template files doesn't have to define the *entire* layout but the content area *only* and should instead specify a template layout which composes the entire page.

Layouts are defined in the `📂 site/templates/layouts/` folder and can be set in your template files using the `$this->layout()` method.

Let's say you have a layout named `site.php` in the `📂 site/templates/layouts/` directory.

This layout might look like this:

```php
<!DOCTYPE html>
<html>
<head>
    <title><?= $page->title() ?> | <?= $site->title() ?></title>
</head>
<body>
    <header>
        <span class="site-title"><?= $this->escape($page->title()) ?></span>
        <nav>
            <ul class="site-nav">
                <?php foreach ($site->children()->listed() as $child): ?>
                    <li><a href="<?= $child->uri() ?>"><?= $child->title() ?></a></li>
                <?php endforeach ?>
            </ul>
        </nav>
    </header>

    <main>
        <?= $this->content() ?>
    </main>

    <footer>
        <p><?= date('Y') ?> <?= $this->escape($page->title()) ?></p>
    </footer>
</body>
</html>
```

Notice how the `<main>` section uses `<?= $this->content() ?>` to include the content of the current page. This is where the template content will be rendered.

Then in our template file, let's say `page.php`, we can set this layout using the `$this->layout()` method at the top:

```php
<?php $this->layout('site') ?>

<h1><?= $page->title() ?></h1>
<?= $page->content() ?>
```

This tells Formwork to use the `site.php` layout for this template. The content of `page.php` will be rendered inside the `<main>` section of the layout, in the place of `<?= $this->content() ?>`.

> [!NOTE]
> In the example above we didn't use the short echo tag `<?=` to call `$this->layout()`, but the tag `<?php` since the method returns nothing to output (has a <code><span class="type-keyword">void</code> return type).

### Inserting partials
Partials are **reusable** pieces of template code that can be inserted in templates. They are useful for defining common UI components, such as headers, footers, or sidebars, that you want to reuse across different pages.

Template partials are stored in the `📂 site/templates/partials/` directory and can be inserted in your templates using the `$this->insert()` method.

Starting from the layout example above, let's say we want to create a reusable partial for the site navigation menu. We can create a file named `menu.php` in the `📂 site/templates/partials/` directory:

```php
<nav>
    <ul class="site-nav">
        <?php foreach ($site->children()->listed() as $child): ?>
            <li><a href="<?= $child->uri() ?>"><?= $child->title() ?></a></li>
        <?php endforeach ?>
    </ul>
</nav>
```

We do the same for the footer, creating a partial named `footer.php`:

```php
<footer>
    <p><?= date('Y') ?> <?= $site->title() ?></p>
</footer>
```

Now we can insert these partials in the `site` layout using the `$this->insert()` method:

```php
<!DOCTYPE html>
<html>
<head>
    <title><?= $page->title() ?> | <?= $site->title() ?></title>
</head>
<body>
    <header>
        <span class="site-title"><?= $this->escape($page->title()) ?></span>
        <?= $this->insert('_menu') ?>
    </header>

    <main>
        <?= $this->content() ?>
    </main>

    <?= $this->insert('_footer') ?>
</body>
</html>
```

> [!NOTE]
> `include()` is not limited to partials, you can include any other partial inside the `📂 site/templates/` folder, even in nested directories (useful to organize them). There are some **conventions**:
>
> - You can use dots instead of slashes to separate directories, so `$this->include('blog/listing')` is equivalent to `$this->include('blog.listing')`.
> - You can omit the `📂 partials/` directory, so `$this->include('_menu')` is equivalent to `$this->include('partials.menu')`.
> - You don't need to specify the `.php` extension but if you do, it won't be added twice.

#### Passing variables to partials
You can pass variables to partials using the second argument of the `$this->insert()` method. This allows you to provide specific data that the partial can use when rendering.

Imagine we have a partial named `info.php` (located in `site/templates/partials/page/info.php`) that displays meta information about a page, such as the author and publish date:

```php
<div class="info">
    Published <?= $page->publishDate()->toDuration() ?> by <?= $page->author() ?>
</div>
```

Then we normally use it in our template like this:

```php
<?= $this->insert('_pages.info') ?>
```

But what if we have a blog page where we want to display the author and publish date of each post in the listing?

```php
<?php foreach ($page->children()->listed() as $post): ?>
    <article>
        <h2><a href="<?= $post->uri() ?>"><?= $this->escape($post->title()) ?></a></h2>
        <?= $this->insert('_pages.info') ?>
        <p><?= $post->summary() ?></p>
    </article>
<?php endforeach ?>
```

This will not work as expected because the `info.php` partial uses the `$page` variable, which refers to the current page, not the post being iterated. In other words, the partial will always repeat the information of the blog page, not the individual posts.

To solve this, we have to pass the `$post` variable to the partial, redefining the `$page` variable. We can do this using the second argument of the `$this->insert()` method, which accepts an associative array of variables:

```php
<?php foreach ($page->children()->listed() as $post): ?>
    <article>
        <h2><a href="<?= $post->uri() ?>"><?= $this->escape($post->title()) ?></a></h2>
        <?= $this->insert('_pages.info', ['page' => $post]) ?>
        <p><?= $post->summary() ?></p>
    </article>
<?php endforeach ?>
```

Of course, you can pass any variable you want, with values that are not necessarily related to the current page.

For example, you have a `message` partial:

```php
<div class="message message-<?= $type ?? 'info' ?>">
    <h2 class="message-title"><?= $this->escape($title) ?></h2>
    <p class="message-body"><?= $this->escape($body) ?></p>
</div>
```

> [!TIP]
> Note that we are using the [**null coalescing operator**](https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.coalesce) `??` in the first line, so if you don't pass the `$type` variable, the default string `'info'` will be used.

Then you can use it in your template like this:

```php
<?= $this->insert('_message', ['type' => 'info', 'title' => 'Greetings', 'body' => '👋 Hello World!']) ?>
```

> [!NOTE]
> When passing variables to partials, keep in mind these important points:
>
> - Remember to omit the `$` symbol in the variables array keys. E.g., `['$page' => $post]` would be not valid.
> - When you pass variables to a partial, they will override the existing variables in the partial's scope. This means that if you pass a variable with the same name as an existing variable in the partial, the passed value will be used instead.
> - Variables passed to partials are not available in the parent template. If you need to access the same variable in the parent template, you must define it in the parent template's scope.

### Defining blocks
Blocks are a way to define sections of a template that can be reused within the template. They are useful for keeping the code simple in the case of alternative layouts.

You can define a block using the `$this->define()` method. This starts capturing the rendered contents until you call `$this->end()`. Then you use the `$this->block()` method to render the block content.

For example, let's say you have a block named `main` that contains the main content of the page. You can define it in your template like this:

```php
<?php $this->define('main') ?>
<main>
    <h1 class="page-title"><?= $this->escape($page->title()) ?></h1>
    <div><?= $page->content() ?></div>
</main>
<?php $this->end() ?>
```

Then, in the templatte you can render this block using the `$this->block()` method. This is useful when you need to conditionally render different page arrangements.

For example, you can use the `main` block in this three-column layout, to conditionally render the sidebar next to the main content:

```php
<?php if ($page->get('sidebar.visible', false)): ?>
    <div class="row">
        <div class="col-2-3">
            <?= $this->block('main') ?>
        </div>
        <div class="col-1-3">
            <?= $this->insert('_sidebar') ?>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-1-1">
            <?= $this->block('main') ?>
        </div>
    </div>
<?php endif ?>
```

> [!NOTE]
> You are not allowed to use <code>content</code> as a block name, because it is reserved for the main content of the page. If you try to define a block named <code>content</code>, a <code><span class="type-name">Formwork\View\Exceptions\RenderingException</span></code> is thrown.

## Template methods
Formwork provides a set of **template methods** that can be used to simplify common tasks in templates. These methods are also available through the `$this` variable.

You can find the complete list of template methods in the [Template methods](/reference/template-methods/) reference.

### Escaping output
When outputting values in templates, it is important to escape them to prevent XSS attacks and ensure that the output is safe for HTML rendering.
Formwork provides the `$this->escape()` method to escape output. This method internally uses the `htmlspecialchars()` function to convert special characters to HTML entities.

For example, to safely output a page title, you can use:

```php
<h1><?= $this->escape($page->title()) ?></h1>
``` 

> [!CAUTION]
> Always escape user-generated or dynamic content before rendering it in HTML. Failing to do so can expose your site to cross-site scripting (XSS) vulnerabilities.

### Working with template assets
Formwork provides methods to work with the template assets, such as images, stylesheets, and scripts.

Template assets are stored in the `📂 site/templates/assets/` directory.

You can use the `$this->asset()` method to generate URIs for assets in your templates.


For example, to include a stylesheet in your template, you can use:

```php
<link rel="stylesheet" href="<?= $this->assets()->get('css/style.css')->uri() ?>">
```

Assets are **versioned** based on their modification time. Yo can use the `includeVersion` argument to append a version query string to the asset URI (for example `?v=6741de63`).

```php
<link rel="stylesheet" href="<?= $this->assets()->get('css/style.css')->uri(includeVersion: true) ?>">
```

> [!NOTE]
> Non-versioned assets are <strong>not cached</strong> by the browser. It is recommended to always set <code>includeVersion: true</code>, especially in production environments as it increases performance and reduce network usage.</p>
</div>


#### Collecting assets
You can use the `$this->assets()` method to collect assets in your templates. This is useful when you want to include multiple assets in your template without knowing beforehand which ones will be needed.

For example, you can collect stylesheets and scripts in your templates or partials like this:

```php
<?php $this->assets()->add('css/style.css') ?>
```
```php
<?php $this->assets()->add('js/script.js') ?>
```

And then in your layout, you can render the collected assets:

```php
<?php foreach ($this->assets()->stylesheets() as $stylesheet): ?>
    <link rel="stylesheet" href="<?= $stylesheet->uri(includeVersion: true) ?>">
<?php endforeach ?>
```
```php
<?php foreach ($this->assets()->scripts() as $script): ?>
    <script src="<?= $script->uri(includeVersion: true) ?>"></script>
<?php endforeach ?>
```

## Template controllers
Formwork allows you to use **template controllers** to separate the logic from the presentation in your templates. Template controllers are PHP files that are executed before the template is rendered, allowing you to prepare data and perform any necessary logic.

Template controllers are stored in the `📂 site/templates/controllers/` folder and are named after the template they control. For example, if you have a template named `blog.php`, you can create a controller named `blog.php` in the `📂 site/templates/controllers/` directory.

The controller file should return an associative array of variables that will be available in the template.

For example, you can create a controller for the `blog` template to handle the logic for pagination.

```php
<?php

use Formwork\Http\ResponseStatus;

// Posts are the published children of the blog page
$posts = $page->children()->published();

// Get the param `{paginationPage}` from the route and cast its value to integer
$paginationPage = (int) $router->params()->get('paginationPage', 1);

// Reverse the order and paginate the posts
$posts = $posts->reverse()->paginate($page->postsPerPage(), $paginationPage);

// Permanently redirect to the URI of the first page (without the `/page/{paginationPage}/`)
// if the `paginationPage` param is given and equals `1`
if ($router->params()->has('paginationPage') && $paginationPage === 1) {
    $this->redirect($posts->pagination()->firstPageUri(), ResponseStatus::MovedPermanently);
}

// If we have no posts or the `paginationPage` params refer to an nonexistent page,
// go to the error page
if ($posts->isEmpty() || !$posts->pagination()->has($paginationPage)) {
    $site->setCurrentPage($site->errorPage());
}

return [
    'posts'      => $posts,
    'pagination' => $posts->pagination()
];

```