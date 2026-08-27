---
title: Color
documentation:
    fields:
        color:
            type: color
description: "A color picker. Lets you choose a color visually."
screenshot: color.png
---

The **color** field allows users to select a color value using the native browser color picker.  
A preview of the selected color and its hexadecimal value is displayed next to the input.

## Field value

The value of a **color** field is a `string`{.type-string} representing a color in hexadecimal format (e.g. `'#ff6600'`).

## Field options

| Option        | Type                   | Description                                                              | Default     |
| ------------- | ---------------------- | ------------------------------------------------------------------------ | ----------- |
| `type`        | `string`{.type-string} | Must be set to `color` to use this field type.                           | `'color'`   |
| `label`       | `string`{.type-string} | The label displayed above the field.                                     | `''`        |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.          | `''`        |
| `default`     | `string`{.type-string} | Default color value in hexadecimal format.                               | `'#000000'` |
| `placeholder` | `string`{.type-string} | Placeholder text displayed when no color is selected.                    | `''`        |
| `class`       | `string`{.type-string} | Additional CSS class names to apply to the input element.                | `''`        |
| `required`    | `bool`{.type-bool}     | If `true`, the field must have a color value before submitting the form. | `false`     |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.             | `false`     |
