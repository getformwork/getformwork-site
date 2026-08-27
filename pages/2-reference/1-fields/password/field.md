---
title: Password
documentation:
    fields:
        password:
            type: password
description: "Masked text for sensitive input."
screenshot: password.png
---

The **password** field allows users to enter a secure password.  
It supports optional minimum and maximum length, pattern validation, and autocomplete control.

## Field value

The value of a **password** field is a `string`{.type-string} containing the password entered by the user.

## Field options

| Option         | Type                   | Description                                                                                                 | Default      |
| -------------- | ---------------------- | ----------------------------------------------------------------------------------------------------------- | ------------ |
| `type`         | `string`{.type-string} | Must be set to `password` to use this field type.                                                           | `'password'` |
| `label`        | `string`{.type-string} | The label displayed above the field.                                                                        | `''`         |
| `description`  | `string`{.type-string} | Optional longer text displayed below the field in smaller size.                                             | `''`         |
| `default`      | `string`{.type-string} | Default password value for the field.                                                                       | `''`         |
| `placeholder`  | `string`{.type-string} | Placeholder text displayed inside the input.                                                                | `''`         |
| `icon`         | `string`{.type-string} | Optional icon displayed inside the input.                                                                   | `''`         |
| `minlength`    | `number`{.type-number} | Minimum number of characters allowed.                                                                       | `null`       |
| `maxlength`    | `number`{.type-number} | Maximum number of characters allowed.                                                                       | `null`       |
| `pattern`      | `string`{.type-string} | Regular expression pattern for validation.                                                                  | `''`         |
| `autocomplete` | `string`{.type-string} | HTML autocomplete attribute (e.g., `'new-password'`).                                                       | `'off'`      |
| `required`     | `bool`{.type-bool}     | If `true`, the field must have a password before submitting the form.                                       | `false`      |
| `disabled`     | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.                                                | `false`      |
| `ignoreEmpty`  | `bool`{.type-bool}     | **Since 2.3.3**{.badge .badge-yellow} If `true`, empty values will be ignored when setting the field value. | `false`      |
