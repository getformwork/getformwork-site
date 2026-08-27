---
title: Email
documentation:
    fields:
        email:
            type: email
description: "A field for email addresses."
screenshot: email.png
---

The **email** field allows users to enter a valid email address and supports HTML5 email validation.  
Optional attributes like minimum and maximum length, pattern, and autocomplete can be configured.

## Field value

The value of an **email** field is a `string`{.type-string} containing a valid email address.

## Field options

| Option         | Type                   | Description                                                              | Default   |
| -------------- | ---------------------- | ------------------------------------------------------------------------ | --------- |
| `type`         | `string`{.type-string} | Must be set to `email` to use this field type.                           | `'email'` |
| `label`        | `string`{.type-string} | The label displayed above the field.                                     | `''`      |
| `description`  | `string`{.type-string} | Optional longer text displayed below the field in smaller size.          | `''`      |
| `default`      | `string`{.type-string} | Default email address for the field.                                     | `''`      |
| `placeholder`  | `string`{.type-string} | Placeholder text displayed inside the input.                             | `''`      |
| `icon`         | `string`{.type-string} | Optional icon displayed inside the input.                                | `''`      |
| `minlength`    | `number`{.type-number} | Minimum number of characters allowed.                                    | `null`    |
| `maxlength`    | `number`{.type-number} | Maximum number of characters allowed.                                    | `null`    |
| `pattern`      | `string`{.type-string} | Regular expression pattern for validation.                               | `''`      |
| `autocomplete` | `string`{.type-string} | HTML autocomplete attribute (e.g., `'email'`).                           | `'off'`   |
| `required`     | `bool`{.type-bool}     | If `true`, the field must have a valid email before submitting the form. | `false`   |
| `disabled`     | `bool`{.type-bool}     | If `true`, the field will be shown as disabled in the Panel.             | `false`   |
