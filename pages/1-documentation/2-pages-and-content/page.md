---
title: 'Pages and content'
description: "Learn how pages store content and metadata, how Markdown is used, and how files and folders define your site's structure."
prevNext: true
---
In Formwork, content is structured as a collection of flat files organized in folders. Each folder represents a page, and each page contains one or more files that define its metadata and content.
This approach gives you full control over your content's structure without relying on a database, and keeps everything easily versionable and portable.

## Page structure

A page in Formwork is a **folder** located under the `📂 site/pages/` directory.

The name of the folder defines the page's slug, which becomes part of the URI. You can prefix the folder name with a number (e.g. `📂 01-about`) to control the order of the pages (see below).

Each page folder typically contains:

* A **content file** with the `.md` extension — the name of this file determines which **template** is used to render the page.

  For example, a file named `blog.md` will be rendered using the `blog.php` template from the `📂 site/templates/` directory. This convention enables flexible content rendering based on content type, without the need for explicit configuration.
* Optional **files** (images, documents, etc.)
* A `.meta.yaml` file for metadata (optional)

This structure keeps content organized and predictable while enabling powerful templating capabilities.


Example:

```
📂 site
  📂 pages
    📂 01-about
      📄 page.md
      🖼 team.jpg
      📄 team.jpg.meta.yaml
```

### Number prefixes

Formwork uses an optional **number prefix** in folder names to define the order of pages.

This is especially useful when working with listed pages, like in navigation menus or blog listings. A page folder prefixed with a number like `01-` (e.g., `📂 01-about`) will be ordered before `📂 02-contact`.

These numbers are stripped from URIs and slugs but retained for sorting. If no prefix is present, pages are typically ordered alphabetically, depending on the file system. Number prefixes offer clear, intuitive control over the structure and presentation of content in the site hierarchy.

> [!TIP]
> You can automate number prefixes in the Panel by setting the `num` option in the page scheme. For example, `num: date` will automatically prefix new page folders with the `publishDate` date in `YYYYMMDD` format (e.g., `📂 20250703-my-post`), which is especially useful for blog or news posts where chronological order matters.

### Slugs and URIs

The **folder name** of a page becomes its **slug** in the URI.

For example, the folder `📂 site/pages/02-about/` yields the URI:

```
https://example.com/about/
```

To customize the slug, you can rename the folder or use the `slug` field in the Panel.

> [!NOTE]
> Slugs must be URI-safe (lowercase, no spaces or special characters except dashes).

### Page hierarchy

Formwork uses **folder structure** to determine the page hierarchy. Nested folders represent child pages.

Example:

```
📂 site
  📂 pages
    📂 01-about
      📄 page.md
      🖼 team.jpg
    📂 02-contact
      📄 contact.md
    📂 03-blog
      📄 blog.md
        📂 20250703-hello-world
          📄 post.md
          🖼 cover.jpg
          🖼 waterfalls.jpg
```

* `📂 03-blog` is a page
* `📂 20250703-hello-world` is a child page of `📂 03-blog`
* `📂 02-contact` and `📂 01-about` are sibling pages of `📂 03-blog`

## Content

Each page in Formwork has a primary content file with the `.md` extension, which holds both metadata and content.

This file follows a structured format consisting of:

* A **YAML frontmatter** block at the beginning
* A **Markdown** body

The frontmatter must be enclosed between triple-dash `---` lines (delimiters) and contains key–value pairs that compile the page's **fields**. These keys correspond to the fields defined in the page's scheme — for example, `title`, `published`, `template`, or any custom field. These values are then made available both in the Panel and during template rendering.

The body follows the frontmatter and contains the actual content displayed on the site, formatted using **Markdown** syntax.

Markdown allows you to write rich text (like headings, bold, lists, links, etc.) in a clean and readable format, making editing content easier for both developers and non-technical users.

Here's an example:

<pre><code class="language-yaml">---
title: About Us
published: true
template: default
---</code><code class="language-markdown">

Welcome to our **About** page!

We are proud to use Formwork.
</code></pre>

### Fields

Fields define the properties and behavior of each page in Formwork. They are declared and validated through the associated page scheme file (`site/schemes/pages/*.yaml`). These definitions not only determine what content a page can contain, but also control how the page is rendered and handled by Formwork and the Panel interface.

### Default fields

Formwork provides a set of **default fields** that define fundamental properties like visibility, routing, caching, and metadata. Their values can be set in the frontmatter of the content file (`.md`) and are automatically exposed to templates.

Most of these fields are also rendered as input controls in the Panel, allowing editors to easily manage page settings and content.

|Field|Type|Description|Default|
|--|--|--|--|
|`title`|<code><span class="type-string">string</span></code>|The page title, displayed in listings and often rendered in templates.|—|
|`published`|<code><span class="type-bool">bool</span></code>|Determines if the page is visible to the public.|`true`|
|`publishDate`|<code><span class="type-string">string</span>\|<span class="type-null">null</span></code>|Optional date from which the page is considered published.|`null`|
|`unpublishDate`|<code><span class="type-string">string</span>\|<span class="type-null">null</span></code>|Optional date after which the page is no longer published.|`null`|
|`routable`|<code><span class="type-bool">bool</span></code>|Controls whether the page has a publicly accessible URL.|`true`|
|`listed`|<code><span class="type-bool">bool</span></code>|If `false`, the page is to be considered hidden from page listings and/or navigation.|`true`|
|`searchable`|<code><span class="type-bool">bool</span></code>|Controls if the page is to be included in search indexing.|`true`|
|`cacheable`|<code><span class="type-bool">bool</span></code>|Whether the page can be cached.|`true`|
|`orderable`|<code><span class="type-bool">bool</span></code>|If the page can be manually reordered in the Panel.|`false`|
|`allowChildren`|<code><span class="type-bool">bool</span></code>|Controls whether the page can have subpages.|`true`|
|`canonicalRoute`|<code><span class="type-string">string</span>\|<span class="type-null">null</span></code>|Route used as the canonical. Route aliases are defined in [site options](../site-options/).|`null`|
|`headers`|<code><span class="type-keyword">array</span></code>|Custom HTTP headers sent when serving the page (e.g., for caching or security).|`[]`|
|`responseStatus`|<code><span class="type-number">int</span></code>|Custom HTTP response status code (e.g., `404` for error pages).|`200`|
|`metadata`|<code><span class="type-keyword">array</span></code>|Associative array of custom meta tags, including Open Graph or SEO values.|`[]`|
|`icon`|<code><span class="type-string">string</span>\|<span class="type-null">null</span></code>|Optional icon name to display next to the page in the Panel.|`null`|

> [!NOTE]
> The <code>listed</code> and <code>searchable</code> fields are <em>descriptive flags</em> meant to be used in your templates. They do not trigger any default behavior. For example, if a page is marked as <code>listed: false</code>, it is up to your navigation template to omit it manually. Similarly, <code>searchable: false</code> pages must be excluded from search results explicitly by your logic.

#### Cache-related fields
Since Formwork **2.1.0**, pages can define their cache settings using the following fields:
|Field|Type|Description|Default|
|--|--|--|--|
|`cache.time`|<code><span class="type-number">int</span></code>|<code><span class="type-number">int</span></code>|Duration (in seconds) for which the page should be cached. If not set, the global cache duration from [site options](../site-options/#cache) is used.|`null`|

> [!TIP]
> Defining a `cache.time` value allows you to fine-tune caching behavior on a per-page basis, optimizing performance for static pages while ensuring dynamic content remains fresh.
> For example, a homepage with dynamic content fetched within a [template controller](../templates/#template-controllers) might benefit from a shorter cache duration, while a static blog post could have a longer cache time.

### Custom fields

In addition to the default fields listed above, pages can define **custom fields** according to their assigned scheme. These fields are flexible and allow you to structure content beyond standard metadata, such as tags, authorship, categories, or any arbitrary data your site needs.

Custom fields are defined inside the page's scheme and populated within the frontmatter of the page's content file. Their structure and behavior (type, default value, validation) are governed by the scheme.

Example with custom fields:

```yaml
---
title: About Us
tags:
    - team
    - company
author: Luca Moretti
cover-image: team.jpg
---
```

These fields can be accessed in templates using the page object, e.g. `$page->author()` or `$page->get('cover-image')`. They are also rendered in the Panel if defined in the scheme's layout.

Custom fields make Formwork powerful and adaptable to different content types, allowing you to model your site's structure with precision and flexibility.

## Files and metadata

Files such as images, documents, and media can be stored or uploaded into the page folder.

You can reference them directly in the content or in templates using specific methods (e.g `$page->files()`, `$page->images()`, `$page->media()`, etc.).

Files may also have metadata files (`filename.meta.yaml`) to store additional information.

For example, an image file `team.jpg`:

* Can be embedded in the content:
  ```markdown
  ![Our Team](/team.jpg)
  ```
* Can be used in templates:
  ```php
  <?= $page->image('team.jpg')->uri() ?>
  ```
* May also have a metadata file `team.jpg.meta.yaml` to store information like alt text, captions, or other attributes.
  ```yaml
  alt: People working together
  description: Our team photo showing collaboration and creativity
  ```