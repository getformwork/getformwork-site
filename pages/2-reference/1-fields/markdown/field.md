---
title: Markdown
documentation:
    fields:
        markdown:
            type: markdown
description: 'Rich text with Markdown formatting.'
---
The **markdown** field allows users to enter rich text content using Markdown syntax.  
It supports images, links, and other media through integrated modals, and provides a toolbar for toggling Markdown mode.

## Field value
The value of a **markdown** field is a <code><span class="type-string">string</span></code> containing the raw Markdown text entered by the user.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `markdown` to use this field type.|`'markdown'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default Markdown content for the field.|`''`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed inside the editor.|`''`|
|`minlength`|<code><span class="type-number">number</span></code>|Minimum number of characters allowed.|`null`|
|`maxlength`|<code><span class="type-number">number</span></code>|Maximum number of characters allowed.|`null`|
|`autocomplete`|<code><span class="type-bool">bool</span></code>|If `true`, the browser will enable autocomplete for the field.|`false`|
|`spellcheck`|<code><span class="type-bool">bool</span></code>|If `true`, spellchecking is enabled in the editor.|`false`|
|`rows`|<code><span class="type-number">number</span></code>|Number of visible rows in the textarea.|`10`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have content before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
