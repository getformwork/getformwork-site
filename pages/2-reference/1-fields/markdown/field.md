---
title: Markdown
documentation:
    fields:
        markdown:
            type: markdown
description: "Rich text with Markdown formatting."
screenshot: markdown.png
---

The **markdown** field allows users to enter rich text content using Markdown syntax.  
It supports images, links, and other media through integrated modals, and provides a toolbar for toggling Markdown mode.

## Field value

The value of a **markdown** field is a `string`{.type-string} containing the raw Markdown text entered by the user.

## Field options

| Option         | Type                   | Description                                                        | Default      |
| -------------- | ---------------------- | ------------------------------------------------------------------ | ------------ |
| `type`         | `string`{.type-string} | Must be set to `markdown` to use this field type.                  | `'markdown'` |
| `label`        | `string`{.type-string} | The label displayed above the field.                               | `''`         |
| `description`  | `string`{.type-string} | Optional longer text displayed below the field in smaller size.    | `''`         |
| `default`      | `string`{.type-string} | Default Markdown content for the field.                            | `''`         |
| `placeholder`  | `string`{.type-string} | Placeholder text displayed inside the editor.                      | `''`         |
| `minlength`    | `number`{.type-number} | Minimum number of characters allowed.                              | `null`       |
| `maxlength`    | `number`{.type-number} | Maximum number of characters allowed.                              | `null`       |
| `autocomplete` | `bool`{.type-bool}     | If `true`, the browser will enable autocomplete for the field.     | `false`      |
| `spellcheck`   | `bool`{.type-bool}     | If `true`, spellchecking is enabled in the editor.                 | `false`      |
| `rows`         | `number`{.type-number} | Number of visible rows in the textarea.                            | `10`         |
| `required`     | `bool`{.type-bool}     | If `true`, the field must have content before submitting the form. | `false`      |
| `disabled`     | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.       | `false`      |
