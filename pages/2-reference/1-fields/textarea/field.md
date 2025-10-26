---
title: Textarea
documentation:
    fields:
        textarea:
            type: textarea
description: 'Multi-line plain text.'
screenshot: textarea.png
---
The **textarea** field allows users to enter multi-line text input.  
It supports placeholder text, minimum and maximum length, autocomplete, spellcheck, and adjustable row count.

## Field value
The value of a **textarea** field is a <code><span class="type-string">string</span></code> containing the text entered by the user.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `textarea` to use this field type.|`'textarea'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default text value for the field.|`''`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed inside the textarea.|`''`|
|`rows`|<code><span class="type-number">number</span></code>|Number of visible text lines.|`5`|
|`minlength`|<code><span class="type-number">number</span></code>|Minimum number of characters allowed.|`null`|
|`maxlength`|<code><span class="type-number">number</span></code>|Maximum number of characters allowed.|`null`|
|`autocomplete`|<code><span class="type-string">string</span></code>|HTML autocomplete attribute (`'on'` or `'off'`).|`'off'`|
|`spellcheck`|<code><span class="type-bool">bool</span></code>|If `true`, enables spell checking in supported browsers.|`false`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have content before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
