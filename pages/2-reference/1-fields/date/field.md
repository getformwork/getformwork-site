---
title: Date
documentation:
    fields:
        date:
            type: date
description: 'Calendar-based date selection. Stores values in `YYYY-MM-DD` format.'
screenshot: date.png
---
The **date** field allows users to select a date or a date and time using a calendar-based picker.  
It supports both date-only and date-time formats depending on the field configuration.

## Field value
The value of a **date** field is a <code><span class="type-string">string</span></code> representing a date or date-time in ISO 8601 format (e.g. `'2025-10-26'` or `'2025-10-26 14:30'` if time is enabled).

## Field options

|Option|Type|Description|Default|
|--|--|--|--|
|`type`|<code><span class="type-string">string</span></code>|Must be set to `date` to use this field type.|`'date'`|
|`label`|<code><span class="type-string">string</span></code>|The label displayed above the field.|`''`|
|`description`|<code><span class="type-string">string</span></code>|Optional longer text displayed below the field in smaller size.|`''`|
|`default`|<code><span class="type-string">string</span></code>|Default date or date-time value in ISO 8601 format.|`''`|
|`placeholder`|<code><span class="type-string">string</span></code>|Placeholder text displayed when no date is selected.|`''`|
|`icon`|<code><span class="type-string">string</span></code>|Name of the icon displayed inside the input.|`'calendar-clock'`|
|`time`|<code><span class="type-bool">bool</span></code>|If `true`, enables time selection in addition to the date.|`false`|
|`required`|<code><span class="type-bool">bool</span></code>|If `true`, the field must have a date before submitting the form.|`false`|
|`disabled`|<code><span class="type-bool">bool</span></code>|If `true`, the field will be shown as disabled in the Panel.|`false`|
