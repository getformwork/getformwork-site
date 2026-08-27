---
title: Page
documentation:
    fields:
        page:
            type: page
description: "Reference to a site page."
screenshot: page.png
---

The **page** field allows users to select a single page from the site’s page collection.  
It supports optional inclusion of the site root and can display page hierarchy with icons.

## Field value

The value of a **page** field is a `string`{.type-string} representing the route of the selected page.

## Field options

| Option        | Type                         | Description                                                                | Default  |
| ------------- | ---------------------------- | -------------------------------------------------------------------------- | -------- |
| `type`        | `string`{.type-string}       | Must be set to `page` to use this field type.                              | `'page'` |
| `label`       | `string`{.type-string}       | The label displayed above the field.                                       | `''`     |
| `description` | `string`{.type-string}       | Optional longer text displayed below the field in smaller size.            | `''`     |
| `default`     | `string`{.type-string}       | Default selected page route.                                               | `''`     |
| `icon`        | `string`{.type-string}       | Icon displayed inside the select input.                                    | `'page'` |
| `collection`  | `PageCollection`{.type-name} | Collection of available pages.                                             |          |
| `allowSite`   | `bool`{.type-bool}           | If `true`, allows selection of the site root (`/`).                        | `false`  |
| `required`    | `bool`{.type-bool}           | If `true`, the field must have a page selected before submitting the form. | `false`  |
| `disabled`    | `bool`{.type-bool}           | If `true`, the field will be shown as disabled in the Panel.               | `false`  |
