---
title: Togglegroup
documentation:
    fields:
        togglegroup:
            type: togglegroup
description: 'Group of toggleable options.'
screenshot: togglegroup.png
---
The **togglegroup** field allows users to select a single option from a group of radio buttons displayed as toggle buttons.  
It supports optional disabling of the entire group.

## Field value
The value of a **togglegroup** field is a <code><span class="type-string">string</span></code> representing the selected option key.

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `togglegroup` to use this field type.|`'togglegroup'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default selected option key.|`''`|
|`options`|<code><span class="type-keyword">array</span></code>|List of available options in the format `key => label`.|`[]`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the entire togglegroup will be disabled.|`false`|
