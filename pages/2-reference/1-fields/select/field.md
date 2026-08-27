---
title: Select
documentation:
    fields:
        select:
            type: select
description: "Single option selector from a predefined list."
screenshot: select.png
---

The **select** field allows users to choose a single value from a predefined list of options.  
It supports optional icons and can be marked as required or disabled.

## Field value

The value of a **select** field is a `string`{.type-string} representing the selected option key.

## Field options

| Option        | Type                   | Description                                                        | Default    |
| ------------- | ---------------------- | ------------------------------------------------------------------ | ---------- |
| `type`        | `string`{.type-string} | Must be set to `select` to use this field type.                    | `'select'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                               | `''`       |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.    | `''`       |
| `default`     | `string`{.type-string} | Default selected option key.                                       | `''`       |
| `icon`        | `string`{.type-string} | Optional icon displayed inside the select input.                   | `''`       |
| `options`     | `array`{.type-keyword} | List of available options in the format `'key' => 'label'`.        | `[]`       |
| `required`    | `bool`{.type-bool}     | If `true`, the field must have a value before submitting the form. | `false`    |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.       | `false`    |
