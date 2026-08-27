---
title: Textarea
documentation:
    fields:
        textarea:
            type: textarea
description: "Multi-line plain text."
screenshot: textarea.png
---

The **textarea** field allows users to enter multi-line text input.  
It supports placeholder text, minimum and maximum length, autocomplete, spellcheck, and adjustable row count.

## Field value

The value of a **textarea** field is a `string`{.type-string} containing the text entered by the user.

## Field options

| Option         | Type                   | Description                                                        | Default      |
| -------------- | ---------------------- | ------------------------------------------------------------------ | ------------ |
| `type`         | `string`{.type-string} | Must be set to `textarea` to use this field type.                  | `'textarea'` |
| `label`        | `string`{.type-string} | The label displayed above the field.                               | `''`         |
| `description`  | `string`{.type-string} | Optional longer text displayed below the field in smaller size.    | `''`         |
| `default`      | `string`{.type-string} | Default text value for the field.                                  | `''`         |
| `placeholder`  | `string`{.type-string} | Placeholder text displayed inside the textarea.                    | `''`         |
| `rows`         | `number`{.type-number} | Number of visible text lines.                                      | `5`          |
| `minlength`    | `number`{.type-number} | Minimum number of characters allowed.                              | `null`       |
| `maxlength`    | `number`{.type-number} | Maximum number of characters allowed.                              | `null`       |
| `autocomplete` | `string`{.type-string} | HTML autocomplete attribute (`'on'` or `'off'`).                   | `'off'`      |
| `spellcheck`   | `bool`{.type-bool}     | If `true`, enables spell checking in supported browsers.           | `false`      |
| `required`     | `bool`{.type-bool}     | If `true`, the field must have content before submitting the form. | `false`      |
| `disabled`     | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.       | `false`      |
