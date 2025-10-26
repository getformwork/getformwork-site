---
title: Text
documentation:
    fields:
        text:
            type: text
description: 'Single-line plain text.'
screenshot: text.png
---
The **text** field allows users to enter a single-line text input.  
It supports optional icons, placeholder text, minimum and maximum length, pattern validation, and autocomplete.

## Field value
The value of a **text** field is a <code><span class="type-string">string</span></code> containing the text entered by the user.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `text` to use this field type.|`'text'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default text value for the field.|`''`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed inside the input.|`''`|
|`icon`|<code><span class="type-string">string</span></code>|Optional icon displayed inside the input.|`''`|
|`class`|<code><span class="type-string">string</span></code>|Optional CSS class added to the input element.|`''`|
|`minlength`|<code><span class="type-number">number</span></code>|Minimum number of characters allowed.|`null`|
|`maxlength`|<code><span class="type-number">number</span></code>|Maximum number of characters allowed.|`null`|
|`pattern`|<code><span class="type-string">string</span></code>|Regular expression pattern for validation.|`''`|
|`autocomplete`|<code><span class="type-string">string</span></code>|HTML autocomplete attribute (e.g., `'on'` or `'off'`).|`'off'`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have content before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
