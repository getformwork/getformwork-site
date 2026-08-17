---
title: Password
documentation:
    fields:
        password:
            type: password
description: 'Masked text for sensitive input.'
screenshot: password.png
---
The **password** field allows users to enter a secure password.  
It supports optional minimum and maximum length, pattern validation, and autocomplete control.

## Field value
The value of a **password** field is a <code><span class="type-string">string</span></code> containing the password entered by the user.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `password` to use this field type.|`'password'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default password value for the field.|`''`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed inside the input.|`''`|
|`icon`|<code><span class="type-string">string</span></code>|Optional icon displayed inside the input.|`''`|
|`minlength`|<code><span class="type-number">number</span></code>|Minimum number of characters allowed.|`null`|
|`maxlength`|<code><span class="type-number">number</span></code>|Maximum number of characters allowed.|`null`|
|`pattern`|<code><span class="type-string">string</span></code>|Regular expression pattern for validation.|`''`|
|`autocomplete`|<code><span class="type-string">string</span></code>|HTML autocomplete attribute (e.g., `'new-password'`).|`'off'`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a password before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
|`ignoreEmpty`|<code><span class="type-bool">bool</span></code>|<span class="badge badge-yellow">Since 2.3.3</span> If `true`, empty values will be ignored when setting the field value.|`false`|