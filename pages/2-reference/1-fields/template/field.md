---
title: Template
documentation:
    fields:
        template:
            type: template
description: 'Page template selector.'
---
The **template** field allows users to select a single template from the available site templates.  

## Field value
The value of a **template** field is a <code><span class="type-string">string</span></code> representing the selected template name.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `template` to use this field type.|`'template'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default selected template name.|`''`|
|`icon`|<code><span class="type-string">string</span></code>|Optional icon displayed inside the select input.|`'template'`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, a template must be selected before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
