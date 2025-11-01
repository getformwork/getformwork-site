---
title: Email
documentation:
    fields:
        email:
            type: email
description: 'A field for email addresses.'
screenshot: email.png
---
The **email** field allows users to enter a valid email address and supports HTML5 email validation.  
Optional attributes like minimum and maximum length, pattern, and autocomplete can be configured.

## Field value
The value of an **email** field is a <code><span class="type-string">string</span></code> containing a valid email address.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `email` to use this field type.|`'email'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default email address for the field.|`''`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed inside the input.|`''`|
|`icon`|<code><span class="type-string">string</span></code>|Optional icon displayed inside the input.|`''`|
|`minlength`|<code><span class="type-number">number</span></code>|Minimum number of characters allowed.|`null`|
|`maxlength`|<code><span class="type-number">number</span></code>|Maximum number of characters allowed.|`null`|
|`pattern`|<code><span class="type-string">string</span></code>|Regular expression pattern for validation.|`''`|
|`autocomplete`|<code><span class="type-string">string</span></code>|HTML autocomplete attribute (e.g., `'email'`).|`'off'`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a valid email before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
