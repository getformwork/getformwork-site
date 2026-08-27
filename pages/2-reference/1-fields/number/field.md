---
title: Number
documentation:
    fields:
        number:
            type: number
description: "Integer or decimal value."
screenshot: number.png
---

The **number** field allows users to enter a numeric value.  
It supports minimum, maximum, and step constraints for precise input control.

## Field value

The value of a **number** field is a `number`{.type-number} representing the numeric value entered by the user.

## Field options

| Option        | Type                   | Description                                                        | Default    |
| ------------- | ---------------------- | ------------------------------------------------------------------ | ---------- |
| `type`        | `string`{.type-string} | Must be set to `number` to use this field type.                    | `'number'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                               | `''`       |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.    | `''`       |
| `default`     | `number`{.type-number} | Default numeric value of the field.                                | `0`        |
| `placeholder` | `string`{.type-string} | Placeholder text displayed inside the input.                       | `''`       |
| `icon`        | `string`{.type-string} | Optional icon displayed inside the input.                          | `''`       |
| `min`         | `number`{.type-number} | Minimum allowed value.                                             | `null`     |
| `max`         | `number`{.type-number} | Maximum allowed value.                                             | `null`     |
| `step`        | `number`{.type-number} | Increment step for the value.                                      | `1`        |
| `required`    | `bool`{.type-bool}     | If `true`, the field must have a value before submitting the form. | `false`    |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.       | `false`    |
