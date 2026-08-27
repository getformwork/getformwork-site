---
title: Range
documentation:
    fields:
        range:
            type: range
description: "Slider for numeric values within a defined range."
screenshot: range.png
---

The **range** field allows users to select a numeric value within a defined range using a slider.  
It supports minimum, maximum, step values, and optional ticks for visual guidance.

## Field value

The value of a **range** field is a `number`{.type-number} representing the selected value on the slider.

## Field options

| Option        | Type                   | Description                                                        | Default   |
| ------------- | ---------------------- | ------------------------------------------------------------------ | --------- |
| `type`        | `string`{.type-string} | Must be set to `range` to use this field type.                     | `'range'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                               | `''`      |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.    | `''`      |
| `default`     | `number`{.type-number} | Default numeric value for the slider.                              | `0`       |
| `min`         | `number`{.type-number} | Minimum allowed value.                                             | `0`       |
| `max`         | `number`{.type-number} | Maximum allowed value.                                             | `100`     |
| `step`        | `number`{.type-number} | Increment step for the value.                                      | `1`       |
| `ticks`       | `array`{.type-keyword} | Optional array of tick values displayed on the slider.             | `[]`      |
| `required`    | `bool`{.type-bool}     | If `true`, the field must have a value before submitting the form. | `false`   |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.       | `false`   |
