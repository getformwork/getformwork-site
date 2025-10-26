---
title: Tags
documentation:
    fields:
        tags:
            type: tags
description: 'List of short text labels.'
screenshot: tags.png
---
The **tags** field allows users to enter multiple tags as a comma-separated list.  
Tags can be selected from predefined options, limited in number, and optionally reordered.

## Field value
The value of a **tags** field is a <code><span class="type-keyword">array</span></code> containing the entered or selected tags.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `tags` to use this field type.|`'tags'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-keyword">array</span></code>|Default tags for the field.|`[]`|
|`icon`|<code><span class="type-string">string</span></code>|Icon displayed inside the input.|`'tag'`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed when no tags are present.|`''`|
|`limit`|<code><span class="type-number">number</span></code>|Maximum number of tags allowed. `0` or `null` for unlimited.|`0`|
|`options`|<code><span class="type-keyword">array</span></code>|Optional predefined tags that can be selected.|`[]`|
|`accept`|<code><span class="type-string">string</span></code>|Defines which values are accepted (`options` to restrict to predefined tags, or other values allowed).|`'all'`|
|`orderable`|<code><span class="type-bool">bool</span></code>|If `true`, users can reorder entered tags.|`false`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have at least one tag before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
