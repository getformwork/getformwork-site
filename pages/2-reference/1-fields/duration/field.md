---
title: Duration
documentation:
    fields:
        duration:
            type: duration
description: "Used for time durations like `1h 30m`. Allows to enter single time components."
screenshot: duration.png
---

The **duration** field allows users to enter a numeric duration, optionally constrained by minimum, maximum, and step values.  
It can display the duration in different units such as seconds, minutes, or hours.

## Field value

The value of a **duration** field is a `number`{.type-number} representing the duration in the specified unit (default is seconds).

## Field options

| Option        | Type                   | Description                                                              | Default      |
| ------------- | ---------------------- | ------------------------------------------------------------------------ | ------------ |
| `type`        | `string`{.type-string} | Must be set to `duration` to use this field type.                        | `'duration'` |
| `label`       | `string`{.type-string} | The label displayed above the field.                                     | `''`         |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.          | `''`         |
| `default`     | `number`{.type-number} | Default numeric value of the duration.                                   | `0`          |
| `min`         | `number`{.type-number} | Minimum allowed value for the field.                                     | `null`       |
| `max`         | `number`{.type-number} | Maximum allowed value for the field.                                     | `null`       |
| `step`        | `number`{.type-number} | Increment step for the value.                                            | `1`          |
| `unit`        | `string`{.type-string} | Unit for the duration value (e.g., `'seconds'`, `'minutes'`, `'hours'`). | `'seconds'`  |
| `intervals`   | `array`{.type-keyword} | Optional array of allowed duration values to restrict user input.        | `[]`         |
| `required`    | `bool`{.type-bool}     | If `true`, the field must have a value before submitting the form.       | `false`      |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.             | `false`      |
