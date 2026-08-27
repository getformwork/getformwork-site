---
title: Text
documentation:
    fields:
        text:
            type: text
description: "Single-line plain text."
screenshot: text.png
---

The **text** field allows users to enter a single-line text input.  
It supports optional icons, placeholder text, minimum and maximum length, pattern validation, and autocomplete.

## Field value

The value of a **text** field is a `string`{.type-string} containing the text entered by the user.

## Field options

| Option         | Type                   | Description                                                        | Default  |
| -------------- | ---------------------- | ------------------------------------------------------------------ | -------- |
| `type`         | `string`{.type-string} | Must be set to `text` to use this field type.                      | `'text'` |
| `label`        | `string`{.type-string} | The label displayed above the field.                               | `''`     |
| `description`  | `string`{.type-string} | Optional longer text displayed below the field in smaller size.    | `''`     |
| `default`      | `string`{.type-string} | Default text value for the field.                                  | `''`     |
| `placeholder`  | `string`{.type-string} | Placeholder text displayed inside the input.                       | `''`     |
| `icon`         | `string`{.type-string} | Optional icon displayed inside the input.                          | `''`     |
| `class`        | `string`{.type-string} | Optional CSS class added to the input element.                     | `''`     |
| `minlength`    | `number`{.type-number} | Minimum number of characters allowed.                              | `null`   |
| `maxlength`    | `number`{.type-number} | Maximum number of characters allowed.                              | `null`   |
| `pattern`      | `string`{.type-string} | Regular expression pattern for validation.                         | `''`     |
| `autocomplete` | `string`{.type-string} | HTML autocomplete attribute (e.g., `'on'` or `'off'`).             | `'off'`  |
| `required`     | `bool`{.type-bool}     | If `true`, the field must have content before submitting the form. | `false`  |
| `disabled`     | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.       | `false`  |
