---
title: Slug
documentation:
    fields:
        slug:
            type: slug
description: 'URL-friendly identifier. It can use a reference field to get the value.'
---
The **slug** field allows users to create a URL-friendly string, often used for page or content identifiers.  
It can automatically generate a slug from a source field, and supports manual editing if not readonly.

## Field value
The value of a **slug** field is a <code><span class="type-string">string</span></code> containing the URL-friendly slug.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `slug` to use this field type.|`'slug'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default slug value.|`''`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed inside the input.|`''`|
|`icon`|<code><span class="type-string">string</span></code>|Optional icon displayed inside the input.|`''`|
|`min`|<code><span class="type-number">number</span></code>|Minimum allowed length of the slug.|`null`|
|`max`|<code><span class="type-number">number</span></code>|Maximum allowed length of the slug.|`null`|
|`pattern`|<code><span class="type-string">string</span></code>|Regular expression pattern for validation.|`''`|
|`readonly`|<code><span class="type-bool">bool</span></code>|If `true`, the field cannot be edited manually.|`false`|
|`source`|<code><span class="type-string">string</span></code>|Name of the field used to automatically generate the slug.|`null`|
|`autoUpdate`|<code><span class="type-bool">bool</span></code>|If `true`, the slug is automatically updated when the source changes.|`true`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a slug before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
