---
title: 'Page schemes'
description: 'Page schemes define the structure, behavior, and editing interface of pages, giving you full control over how content is managed.'
prevNext: true
---
**Page schemes** in Formwork define the **structure and content model** of pages. They describe what kind of data each page type contains, how that data is organized, and how it relates to other pages. This makes schemes a central tool for designing the content architecture of a Formwork site.

Schemes allow you to:

* Define what fields are available for each page type (e.g., title, text, images)
* Group and organize fields into sections
* Enforce rules for page templates, slugs, and parents
* Control page behavior and relationships (e.g., children templates, routing options)
* Extend or override other schemes to reduce repetition and maintain consistency

While schemes also determine how content is displayed and edited in the administration Panel, their role goes beyond appearance—they govern the data structure of your site itself.

Schemes are written in YAML and stored in `📂 site/schemes/pages/`.

Each scheme corresponds to a page template and is automatically loaded based on the `template` property of the page.

This system is highly flexible and allows for both simple and complex content structures, enabling developers to define consistent models while retaining full control over how content is managed and validated.

## Structure of a page scheme
A typical page scheme is composed of the following top-level keys:

* `title`
* `options`
* `layout`
* `fields`

## Title property
The `title` property defines the scheme title, which should be based on the scheme name, corresponding to the file name.
It is also the label displayed in the Panel.
It can be a static string like this:

```yaml
title: Page
```

You can also translate the scheme title using an array of language identifiers and translated strings:

```yaml
title:
    en: Page
    it: Pagina
    de: Seite
```

You can instead use a reference a translation string:

```yaml
title: '{{page.page}}'
```

## Options section
The options section defines general metadata about the page scheme.

For example:
```yaml
options:
    icon: page
    allowPagination: true
    children: false
```

Common options include:

|Option|Type|Description|
|--|--|--|
|`icon`|<code><span class="type-string">string</span></code>|The icon shown in the Panel page list|
|`allowPagination`|<code><span class="type-bool">bool</span></code>|Enables support for pagination on this page type, making the pagination route reachable|
|`allowTags`|<code><span class="type-bool">bool</span></code>|<span class="badge badge-red">Deprecated since 2.2.0</span> Controls whether tags are available for pages using this template, making the tags route reachable. Use `allowTaxonomy` instead|
|`allowTaxonomy`|<code><span class="type-bool">bool</span></code>|<span class="badge badge-yellow">Since 2.2.0</span> Enables the routes for th taxonomies defined in the [site options](../site-options/#taxonomies) (tags, categories, etc.)|
|`num`|<code><span class="type-string">string</span></code>|The page numbering mode|
|`children`|<code><span class="type-keyword">array</span></code>\|<code><span class="type-bool">bool</span></code>|Specifies settings for child pages (see below)|
|`imagePreviewField`|<code><span class="type-string">string</span></code>|The name of an [`image` field](/reference/fields/image/) to be used as preview thumbnail in the Panel page list|

> [!NOTE]
> If you want to use pagination and/or taxonomy using routes like `/notes/page/3/`, `/posts/tag/recipes/` or `/photos/tag/landscape/page/2/` you have to enable the `allowPagination` and `allowTaxonomy` respectively.
>
> Otherwise, and by default, Formwork tries to resolve all the route segments to a page, leading to 404 errors.

> [!TIP]
> Formwork does not enforce a particular set of properties in the `options` section.
>
> This is to leave the flexibility to define custom options which can be retrieved programmatically in templates.

### Page children options
Here in detail the `children` options currently handled by Formwork:

|Option|Type|Description|
|--|--|--|
|`templates`|<code><span class="type-keyword">array</span></code>|Limits which templates can be used by children of this page|
|`reverse`|<code><span class="type-bool">bool</span></code>|Displays children in reverse order in the Panel|
|`orderable`|<code><span class="type-bool">bool</span></code>|If `false`, disables drag-and-drop sorting for children in the Panel|
|`subtree`|<code><span class="type-bool">bool</span></code>|<span class="badge badge-yellow">Since 2.1.0</span> If `true` children pages are not visible in the main site tree in the Panel but in their own page, allowing tree navigation|

For example you have a `blog` content model which contains only `post` pages, and you want to prevent users from assigning unrelated templates as children, you also want to disable manual sorting, since posts are ordered by publish date and then display them in reverse order. Your `options` section in the `blog` scheme will be like this:

```yaml
options:
    children:
        templates: [post]
        reverse: true
        orderable: false
```

> [!NOTE]
> As with [configuration](../system-options/) you should always prefer **nesting** to **dot notation** in YAML schemes to ensure better readability.

## Layout section

The `layout` section determines how fields are organized into **sections** in the Panel.

Each section supports these properties:

|Option|Type|Description|
|--|--|--|
|`label`|<code><span class="type-string">string</span></code>|Display label for the section (can be translated)|
|`fields`|<code><span class="type-keyword">array</span></code>|List of field names (referenced from the `fields` section)|
|`collapsed`|<code><span class="type-bool">bool</span></code>|If `true`, the section is collapsed by default|
|`order`|<code><span class="type-int">int</span></code>|<span class="badge badge-yellow">Since 2.2.0</span> Defines the order of the section among other sections (lower numbers appear first)|

Example:

```yaml
layout:
    sections:
        content:
            label: '{{page.content}}'
            fields: [title, content]
            collapsed: false
```

### Tabs
<span class="badge badge-yellow">Since 2.2.0</span>

You can organize sections into **tabs** by adding the `tab` property to the `layout` section.
Let's say you want to create two tabs: one for content-related sections and another for options-related sections.

```yaml
layout:
    tabs:
        content:
            label: '{{page.content}}'

        options:
            label: '{{page.options}}'
```

Then assign sections to tabs using the `tab` property, for example this is the built-in `page` scheme layout:

```yaml
    sections:
        page:
            label: '{{page.page}}'
            active: true
            fields: [title, content, description]
            tab: content

        status:
            label: '{{page.status}}'
            fields: [published, publishDate, unpublishDate, routable, listed, cacheable]
            tab: options
```

## Fields section
The `fields` section defines all input fields available for the page. Each field is defined with a unique name and its configuration, which includes:

|Option|Type|Description|
|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Field type (e.g., `text`, `markdown`, `checkbox`, `date`, `upload`). See the reference for the [20+ built-in field types](../../reference/fields/).|
|`label`|<code><span class="type-string">string</span></code>|Display label for the field (supports translation)|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must be filled to save the page|
|`default`|<code><span class="type-keyword">mixed</span></code>|Default value used for new pages or empty inputs|
|`description`|<code><span class="type-string">string</span></code>|Optional help text shown under the field. Supports Markdown syntax|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text for inputs|
|`readonly`|<code><span class="type-bool">string</span></code>|If `true`, the field is readonly|
|`visible`|<code><span class="type-bool">string</span></code>|If `false`, the field is not rendered in the panel|

## Dynamic field properties
Formwork supports **dynamic field properties**, a powerful feature that allows field configurations in schemes to respond to runtime conditions such as the current page, site, or environment (the `formwork` object, which represents the CMS). This means that fields can behave differently depending on the context in which they are used—without the need for duplicated scheme definitions.

Dynamic fields make schemes more **flexible** and **adaptive**, and are especially useful for customizing visibility, options, and defaults, based on dynamic logic.

They help ensure your editing interface stays clean, and relevant, adapting to the shape of your content automatically.

In any field definition, you can mark a property as dynamic by appending `@` to its name, like this:

```yaml
fields:

    slug:
        type: slug
        label: '{{page.slug}}'
        readonly@: page.isSlugReadonly
        # ...

    template:
        type: template
        default@: site.get('defaultTemplate', 'default')
        # ...

    parent:
        type: page
        collection@: site.descendants.allowingChildren.withoutPageAndDescendants(page)
        # ...
```

At runtime, Formwork evaluates the expression after the `@` using its internal expression language, which allows referencing:

|Variable|Type|Description|
|--|--|--|
|`page`|<code><span class="type-name">Formwork\Pages\Page</span></code>|The current page. See [API reference](../../reference/api/page/) for available methods|
|`site`|<code><span class="type-name">Formwork\Cms\Site</span></code>|The site. See [API reference](../../reference/api/site/) for available methods|
|`formwork`|<code><span class="type-name">Formwork\Cms\App</span></code>|The global CMS instance. [API reference](../../reference/api/app/) for available methods|

These expressions are executed when the field properties are accessed, and the resulting value replaces the dynamic expression.

You can use these properties on most field attributes, including `label`, `placeholder`, `required`, `visible`, and `options`.

## Extending schemes
In Formwork, **page schemes** can be extended from other schemes using the `extend` property. This allows you to reuse and customize existing configurations, keeping your scheme definitions clean and DRY (Don't Repeat Yourself).

### Extend property
Let's say you you want to create a new scheme for a `product` page and you only need to add or override the basic properties from the `page` scheme.

You can do this by using the `extend` property at the top of your scheme definition:

```yaml
extend: pages.page
```

This directive means the current scheme **inherits** all definitions from the `pages.page` scheme, including fields, layout, and options.

You can then **add or override** the base fields, layout sections, or configuration without redefining everything.

### Adding more fields
To add new fields, simply define them in the `fields` section of your scheme:

```yaml
title: Product

extend: pages.page

# ...

fields:
    price:
        type: number
        label: Price
        required: true
        description: The price of the product
    
    stock:
        type: number
        label: Stock
        default: 0
        description: The available stock for the product
```

Then you can append these new fields to a section in the `layout`, for example the `content` section:

```yaml
layout:
    type: sections
    sections:
        content:
            label: '{{page.content}}'
            fields: [title, content, price, stock]
```

> [!NOTE]
> Since you are adding fields to an existing section in the base scheme, you need to include the base fields in the order you prefer.

### Overriding and adding properties to existing fields

You want your `product` pages to be not text-heavy, so you want to change the `content` field label to a more specific one, like `Description`.
You can override the existing field by defining it again in your scheme:

```yaml
fields:
    content:
        # Override the field label
        label: Description
```

This will override the `label` property of the `content` field defined in the base scheme.

You want also to alter the field appearance to make it shorter. To do so you can add the `rows` property:

```yaml
fields:
    content:
        label: Description

        # Add a property to the field which is not defined in the base scheme
        rows: 5
```

This will define the `rows` property of the `content` field.