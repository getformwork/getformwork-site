---
title: Checkbox
documentation:
    fields:
        checkbox:
            type: checkbox
description: "A single boolean toggle. Use it for yes/no options."
screenshot: checkbox.png
---

The **checkbox** field allows users to toggle a boolean value on or off.

## Field value

The value of a **checkbox** field is a `bool`{.type-bool}, which can be either `true` (checked) or `false` (unchecked).

## Field options

| Option        | Type                   | Description                                                                | Default      |
| ------------- | ---------------------- | -------------------------------------------------------------------------- | ------------ |
| `type`        | `string`{.type-string} | Must be set to `checkbox` to use this field type.                          | `'checkbox'` |
| `label`       | `string`{.type-string} | The label displayed next to the checkbox input.                            | `''`         |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.            | `''`         |
| `default`     | `bool`{.type-bool}     | Default state of the checkbox (`true` for checked, `false` for unchecked). | `false`      |
| `required`    | `bool`{.type-bool}     | If `true`, the field must be checked before submitting the form.           | `false`      |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.               | `false`      |
