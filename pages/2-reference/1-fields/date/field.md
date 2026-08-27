---
title: Date
documentation:
    fields:
        date:
            type: date
description: "Calendar-based date selection. Stores values in `YYYY-MM-DD` format."
screenshot: date.png
---

The **date** field allows users to select a date or a date and time using a calendar-based picker.  
It supports both date-only and date-time formats depending on the field configuration.

## Field value

The value of a **date** field is a `string`{.type-string} representing a date or date-time in ISO 8601 format (e.g. `'2025-10-26'` or `'2025-10-26 14:30'` if time is enabled).

## Field options

| Option        | Type                   | Description                                                       | Default            |
| ------------- | ---------------------- | ----------------------------------------------------------------- | ------------------ |
| `type`        | `string`{.type-string} | Must be set to `date` to use this field type.                     | `'date'`           |
| `label`       | `string`{.type-string} | The label displayed above the field.                              | `''`               |
| `description` | `string`{.type-string} | Optional longer text displayed below the field in smaller size.   | `''`               |
| `default`     | `string`{.type-string} | Default date or date-time value in ISO 8601 format.               | `''`               |
| `placeholder` | `string`{.type-string} | Placeholder text displayed when no date is selected.              | `''`               |
| `icon`        | `string`{.type-string} | Name of the icon displayed inside the input.                      | `'calendar-clock'` |
| `time`        | `bool`{.type-bool}     | If `true`, enables time selection in addition to the date.        | `true`             |
| `required`    | `bool`{.type-bool}     | If `true`, the field must have a date before submitting the form. | `false`            |
| `disabled`    | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.      | `false`            |
