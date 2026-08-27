---
title: "System options"
description: "Explore all configuration options available in `config/system.yaml` to customize how Formwork behaves under the hood."
prevNext: true
---

Formwork's system configuration defines global settings that control core behavior across the entire CMS, including how pages, files, images, caching, user accounts, the panel interface, and more are managed.

Configuration is written in **YAML** format and is designed to be simple, human-readable, and flexible.

## Configuration files and location

There are two main configuration files involved:

- **Default configuration**: `formwork/config/system.yaml`

    This file contains the base configuration defined by Formwork.

> [!WARNING]
> You should not modify this file directly, as it contains sensible defaults and may be replaced with updates. Instead, copy the relevant options to your site-specific configuration file.

- **Site-specific configuration**: `site/config/system.yaml`

    You should make your custom changes here.

When the system loads its configuration, it merges the **site-specific configuration** with the **default values**.

> [!NOTE]
> When updating options from the Panel, only the options that differ from the defaults are saved to the site-specific system configuration file.

## Configuration structure

Formwork configuration uses a **nested structure** to organize options hierarchically, making it easy to read and maintain.

Each top-level section (like `cache`, `panel`, or `pages`) contain multiple sub-options organized hierarchically.

Formwork supports both **nested keys** and **dot notation** for defining options. These notations are functionally equivalent — internally, they are treated the same.

For example, the following two configurations are equivalent:

```yaml
panel:
    enabled: true
    path: "${%ROOT_PATH%}/panel"
```

```yaml
panel.enabled: true
panel.path: "${%ROOT_PATH%}/panel"
```

While dot notation may be convenient for compact overrides or programmatic generation, **nested structure is recommended** for readability and clarity, especially in larger configuration files.

> [!TIP]
> Use dot notation when referencing options in templates, schemes, or code, but prefer nested arrays in YAML for editing and maintenance.

> [!NOTE]
> Values may include **environment variables** or **placeholders** (e.g., `${%ROOT_PATH%}`) that are resolved at runtime.

## Placeholder variables

Formwork uses placeholder variables wrapped in `${...}` to represent paths and other values that can change based on the environment or installation.

These make paths adaptable and environment-independent.

| Placeholder      | Description                          |
| ---------------- | ------------------------------------ |
| `%ROOT_PATH%`    | Root directory of the installation   |
| `%SYSTEM_PATH%`  | System core directory (/formwork)    |
| `system.panel.*` | Values referencing other system keys |

> [!CAUTION]
> Be cautious when modifying the `files.allowedExtensions` option. Allowing upload of certain file types — such as executable scripts (`.php`, `.js`, `.sh`) — can pose a **serious security risk** if those files are made accessible through the web server. It's recommended to allow only safe, expected file types like documents (`.pdf`, `.txt`) and media files (`.jpg`, `.png`, `.mp4`).

> [!CAUTION]
> Use caution when configuring `files.uploads.baseDestinations`. Allowing uploads to sensitive directories such as `site`, `formwork`, or `panel` can lead to unexpected behavior, including overwriting core files, templates, or user content. Ensure that only safe, intended paths are included and that uploaded files do not affect system integrity.

## Performance and configuration caching

Although Formwork's configuration files are written in YAML for readability and ease of editing, performance is not a concern when reading them.

**Formwork automatically compiles all YAML configuration into a single cached PHP file**, which is stored and reused to avoid repeated parsing.

This PHP-based cache is optimized to take full advantage of **PHP OPcache**, ensuring that configuration values are loaded quickly with minimal overhead.

> [!NOTE]
> The configuration cache is automatically updated whenever you make changes through the Panel or manually edit configuration files. No manual cache clearing is required.

## Configuration options

Here a detailed overview of each configuration section and its options.

### Authentication {.is-new}

**Since 2.3.0**{.badge .badge-yellow}

Specifies authentication settings.

| Option                              | Type                   | Description                                            | Default                             |
| ----------------------------------- | ---------------------- | ------------------------------------------------------ | ----------------------------------- |
| `authentication.registryPath`       | `string`{.type-string} | Path to the authentication registry                    | `${%ROOT_PATH%}/site/auth/registry` |
| `authentication.limits.maxAttempts` | `int`{.type-number}    | Maximum number of authentication attempts              | `10`                                |
| `authentication.limits.resetTime`   | `int`{.type-number}    | Time (in seconds) before authentication attempts reset | `300`                               |

### Backup

Handles automatic site backups, including location, naming, file limits, and ignored files and folders.

| Option                    | Type                   | Description                                            | Default                                                                                                       |
| ------------------------- | ---------------------- | ------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------- |
| `backup.path`             | `string`{.type-string} | Path to store backup files                             | `${%ROOT_PATH%}/backup`                                                                                       |
| `backup.name`             | `string`{.type-string} | Prefix used for backup filenames                       | `formwork-backup`                                                                                             |
| `backup.maxExecutionTime` | `int`{.type-number}    | Maximum allowed execution time for backup (in seconds) | `180`                                                                                                         |
| `backup.maxFiles`         | `int`{.type-number}    | Maximum number of backups to retain                    | `10`                                                                                                          |
| `backup.ignore`           | `array`{.type-keyword} | Wildcard patterns to exclude from backups              | [See default config](https://github.com/getformwork/formwork/blob/2.3.14/formwork/config/system.yaml#L12-L24) |

### Cache

Manages the page cache system, controlling whether page caching is enabled, and their expiration time.

| Option          | Type                   | Description                      | Default                      |
| --------------- | ---------------------- | -------------------------------- | ---------------------------- |
| `cache.enabled` | `bool`{.type-bool}     | Enable or disable page caching   | `false`                      |
| `cache.path`    | `string`{.type-string} | Directory path for cache storage | `${%ROOT_PATH%}/cache/pages` |
| `cache.time`    | `int`{.type-number}    | Cache lifetime in seconds        | `604800`                     |

### Charset

Specifies the character encoding used throughout the system (typically `utf-8`).

> [!WARNING]
> The `charset` option should always remain set to `utf-8`. Changing the character encoding can cause unexpected behavior, data corruption, or rendering issues across your site. UTF-8 is the standard and fully supported encoding in Formwork for all content, metadata, and file handling.

| Option    | Type                   | Description                                   | Default |
| --------- | ---------------------- | --------------------------------------------- | ------- |
| `charset` | `string`{.type-string} | Character encoding used throughout the system | `utf-8` |

### Date

Controls date and time formatting, time zone settings, and the first day of the week.

| Option                | Type                   | Description                                                                                                | Default                                               |
| --------------------- | ---------------------- | ---------------------------------------------------------------------------------------------------------- | ----------------------------------------------------- |
| `date.dateFormat`     | `string`{.type-string} | Date format string. See the PHP manual for the [syntax](https://www.php.net/manual/en/datetime.format.php) | `Y-m-d`                                               |
| `date.timeFormat`     | `string`{.type-string} | Time format string. See the PHP manual for the [syntax](https://www.php.net/manual/en/datetime.format.php) | `h:i A`                                               |
| `date.datetimeFormat` | `string`{.type-string} | Combined date and time format                                                                              | `${system.date.dateFormat} ${system.date.timeFormat}` |
| `date.timezone`       | `string`{.type-string} | Default timezone. See the PHP manual for the [timezones list](https://www.php.net/manual/en/timezones.php) | `UTC`                                                 |
| `date.weekStarts`     | `int`{.type-number}    | First day of the week (0 = Sunday, 1 = Monday)                                                             | `0`                                                   |

### Debug

Provides debugging options like enabling debug mode, setting a code editor for file links, and adjusting stack trace context.

> [!WARNING]
> The `debug.enabled` option should always be disabled (`false`) on production servers. Enabling debug mode can expose sensitive information and detailed error traces that may compromise your site security.

| Option               | Type                   | Description                                         | Default                               |
| -------------------- | ---------------------- | --------------------------------------------------- | ------------------------------------- |
| `debug.enabled`      | `bool`{.type-bool}     | Enable or disable debug mode                        | `false`                               |
| `debug.editorUri`    | `string`{.type-string} | URI template for linking to the local editor        | `editor://file/{{filename}}:{{line}}` |
| `debug.contextLines` | `int`{.type-number}    | Number of lines to show above and below error lines | `5`                                   |

### Fields

Defines the location of field types and dynamic variables used in page schemes.

| Option                     | Type                   | Description                                                        | Default                                    |
| -------------------------- | ---------------------- | ------------------------------------------------------------------ | ------------------------------------------ |
| `fields.path`              | `string`{.type-string} | Path to field types                                                | `${%SYSTEM_PATH%}/fields`                  |
| `fields.dynamic.vars.file` | `string`{.type-string} | PHP file defining dynamic variables available in field definitions | `${%SYSTEM_PATH%}/fields/dynamic/vars.php` |

### Files

Controls file handling, including allowed extensions, metadata storage, and upload destinations.

> [!CAUTION]
> Be cautious when modifying the `files.allowedExtensions` option. Allowing upload of certain file types — such as executable scripts (`.php`, `.js`, `.sh`) — can pose a **serious security risk** if those files are made accessible through the web server. It's recommended to allow only safe, expected file types like documents (`.pdf`, `.txt`) and media files (`.jpg`, `.png`, `.mp4`).

> [!CAUTION]
> Use caution when configuring `files.uploads.baseDestinations`. Allowing uploads to sensitive directories such as `site`, `formwork`, or `panel` can lead to unexpected behavior, including overwriting core files, templates, or user content. Ensure that only safe, intended paths are included and that uploaded files do not affect system integrity.

| Option                           | Type                   | Description                                  | Default                                                                                                       |
| -------------------------------- | ---------------------- | -------------------------------------------- | ------------------------------------------------------------------------------------------------------------- |
| `files.allowedExtensions`        | `array`{.type-keyword} | List of allowed file extensions              | `[]`                                                                                                          |
| `files.metadataExtension`        | `string`{.type-string} | Extension used for metadata files            | `.meta.yaml`                                                                                                  |
| `files.paths.site`               | `string`{.type-string} | Directory for publicly accessible site files | `${%ROOT_PATH%}/site/files`                                                                                   |
| `files.uploads.path`             | `string`{.type-string} | Upload destination for files (default path)  | `${%ROOT_PATH%}/site/files`                                                                                   |
| `files.uploads.baseDestinations` | `array`{.type-keyword} | Directories allowed for file uploads         | [See default config](https://github.com/getformwork/formwork/blob/2.3.14/formwork/config/system.yaml#L58-L62) |

### Images

Sets default parameters for image processing, such as compression, quality, metadata preservation, and cache location.

| Option                        | Type                   | Description                                              | Default                       |
| ----------------------------- | ---------------------- | -------------------------------------------------------- | ----------------------------- |
| `images.jpegQuality`          | `int`{.type-number}    | JPEG image quality (0–100)                               | `85`                          |
| `images.jpegProgressive`      | `bool`{.type-bool}     | Whether to generate progressive JPEGs                    | `true`                        |
| `images.pngCompression`       | `int`{.type-number}    | PNG compression level (0–9)                              | `6`                           |
| `images.webpQuality`          | `int`{.type-number}    | WebP image quality (0–100)                               | `85`                          |
| `images.gifColors`            | `int`{.type-number}    | Max number of colors in GIF images                       | `256`                         |
| `images.processPath`          | `string`{.type-string} | Path to store processed images                           | `${%ROOT_PATH%}/cache/images` |
| `images.preserveColorProfile` | `bool`{.type-bool}     | Keep embedded color profiles in images                   | `true`                        |
| `images.preserveExifData`     | `bool`{.type-bool}     | Preserve EXIF metadata when processing images            | `true`                        |
| `images.clearCacheByDefault`  | `bool`{.type-bool}     | Whether to clear cached images by default from the Panel | `false`                       |

### Logs {.is-new}

**Since 2.3.0**{.badge .badge-yellow}

Logging-related configuration.

| Option                        | Type                   | Description                                                                                                   | Default                            |
| ----------------------------- | ---------------------- | ------------------------------------------------------------------------------------------------------------- | ---------------------------------- |
| `logs.handlers.default.type`  | `string`{.type-string} | Handler type for the default logger (`file` and `stderr` are currently supported)                             | `file`                             |
| `logs.handlers.default.path`  | `string`{.type-string} | Path to the log file (only used for `file` handler type)                                                      | `${%ROOT_PATH%}/logs/formwork.log` |
| `logs.handlers.default.level` | `string`{.type-string} | Minimum log level to record (`debug`, `info`, `notice`, `warning`, `error`, `critical`, `alert`, `emergency`) | `info`                             |

### Metadata

Manages global metadata settings like whether to include a Formwork generator meta tag in page headers.

| Option                  | Type               | Description                                         | Default |
| ----------------------- | ------------------ | --------------------------------------------------- | ------- |
| `metadata.setGenerator` | `bool`{.type-bool} | Include Formwork generator meta tag in page headers | `true`  |

### Pages

Configures core page system behavior, such as the storage path, homepage and error page slugs, and content file options.

| Option                               | Type                   | Description                                                                                                               | Default                     |
| ------------------------------------ | ---------------------- | ------------------------------------------------------------------------------------------------------------------------- | --------------------------- |
| `pages.path`                         | `string`{.type-string} | Path to the pages directory                                                                                               | `${%ROOT_PATH%}/site/pages` |
| `pages.index`                        | `string`{.type-string} | Slug for the site homepage                                                                                                | `index`                     |
| `pages.error`                        | `string`{.type-string} | Slug for the site error page                                                                                              | `error`                     |
| `pages.content.extension`            | `string`{.type-string} | File extension used for page content files                                                                                | `.md`                       |
| `pages.content.allowHtml`            | `bool`{.type-bool}     | Allow HTML inside content files                                                                                           | `false`                     |
| `pages.content.addHeadingIds`        | `bool`{.type-bool}     | Automatically add IDs to headings in content files                                                                        | `false`                     |
| `pages.content.commonmarkExtensions` | `array`{.type-keyword} | List of [CommonMark extensions](https://commonmark.thephpleague.com/2.x/extensions/overview/) to enable and their options | `[]`                        |

### Panel

Defines how the administration interface behaves, including path, session settings, login limitations, and file structure.

| Option                    | Type                   | Description                                                                                                                                 | Default                                      |
| ------------------------- | ---------------------- | ------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------- |
| `panel.enabled`           | `bool`{.type-bool}     | Enable or disable the administration panel                                                                                                  | `true`                                       |
| `panel.root`              | `string`{.type-string} | URL segment for accessing the panel                                                                                                         | `panel`                                      |
| `panel.path`              | `string`{.type-string} | Filesystem path to the panel                                                                                                                | `${%ROOT_PATH%}/panel`                       |
| `panel.translation`       | `string`{.type-string} | Default language for the panel interface                                                                                                    | `en`                                         |
| `panel.loginAttempts`     | `int`{.type-number}    | **Deprecated since 2.3.0**{.badge .badge-red} Maximum allowed failed login attempts. Use `authentication.limits.maxAttempts` instead.       | `10`                                         |
| `panel.loginResetTime`    | `int`{.type-number}    | **Deprecated since 2.3.0**{.badge .badge-red} Time (in seconds) before login attempts reset. Use `authentication.limits.resetTime` instead. | `300`                                        |
| `panel.logoutRedirect`    | `string`{.type-string} | Redirect route after logout                                                                                                                 | `login`                                      |
| `panel.sessionTimeout`    | `int`{.type-number}    | **Deprecated since 2.3.0**{.badge .badge-red} Session timeout in minutes. Use `session.duration` instead.                                   | `120`                                        |
| `panel.userImageSize`     | `int`{.type-number}    | Dimension (in px) of uploaded user avatars                                                                                                  | `512`                                        |
| `panel.colorScheme`       | `string`{.type-string} | Default color scheme of the panel (light/dark/auto)                                                                                         | `light`                                      |
| `panel.paths.assets`      | `string`{.type-string} | Path to panel assets                                                                                                                        | `${system.panel.path}/assets`                |
| `panel.paths.logs`        | `string`{.type-string} | Path to panel log files                                                                                                                     | `${system.panel.path}/logs`                  |
| `panel.paths.modals`      | `string`{.type-string} | Path to reusable modal components                                                                                                           | `${system.panel.path}/modals`                |
| `panel.config.app`        | `string`{.type-string} | Path to main panel app configuration                                                                                                        | `${system.panel.path}/config/app.php`        |
| `panel.config.navigation` | `string`{.type-string} | Path to panel navigation config                                                                                                             | `${system.panel.path}/config/navigation.php` |

### Plugins {.is-new}

**Since 2.3.0**{.badge .badge-yellow}

Specifies where plugins are stored and their configuration files.

| Option            | Type                   | Description                | Default                       |
| ----------------- | ---------------------- | -------------------------- | ----------------------------- |
| `plugins.enabled` | `bool`{.type-bool}     | Enable or disable plugins  | `true`                        |
| `plugins.path`    | `string`{.type-string} | Path to plugin directories | `${%ROOT_PATH%}/site/plugins` |

### Users

Specifies where user accounts, profile images, and role definitions are stored.

| Option                 | Type                   | Description                    | Default                              |
| ---------------------- | ---------------------- | ------------------------------ | ------------------------------------ |
| `users.paths.accounts` | `string`{.type-string} | Path to user account files     | `${%ROOT_PATH%}/site/users/accounts` |
| `users.paths.images`   | `string`{.type-string} | Path to user avatar images     | `${%ROOT_PATH%}/site/users/images`   |
| `users.paths.roles`    | `string`{.type-string} | Path to user roles definitions | `${%ROOT_PATH%}/site/users/roles`    |

### Routes

Configures the routing system by pointing to route definition files for the panel and core system.

| Option                | Type                   | Description                      | Default                                         |
| --------------------- | ---------------------- | -------------------------------- | ----------------------------------------------- |
| `routes.files.panel`  | `string`{.type-string} | Path to panel route definitions  | `${system.panel.path}/config/routes/routes.php` |
| `routes.files.system` | `string`{.type-string} | Path to system route definitions | `${%SYSTEM_PATH%}/config/routes/routes.php`     |

### Schemes

Manages the paths to panel, system, and site-level YAML schemes that define editable structures (like pages and users).

| Option                 | Type                   | Description                   | Default                        |
| ---------------------- | ---------------------- | ----------------------------- | ------------------------------ |
| `schemes.paths.panel`  | `string`{.type-string} | Path to panel schemes         | `${system.panel.path}/schemes` |
| `schemes.paths.system` | `string`{.type-string} | Path to system schemes        | `${%SYSTEM_PATH%}/schemes`     |
| `schemes.paths.site`   | `string`{.type-string} | Path to site-specific schemes | `${%ROOT_PATH%}/site/schemes`  |

### Session {.is-new}

**Since 2.3.0**{.badge .badge-yellow}

Controls session behavior.

| Option             | Type                   | Description                 | Default                        |
| ------------------ | ---------------------- | --------------------------- | ------------------------------ |
| `session.path`     | `string`{.type-string} | Path to store session files | `${%ROOT_PATH%}/site/sessions` |
| `session.duration` | `int`{.type-number}    | Session duration in seconds | `7200`                         |

### Templates

Defines where page templates are stored and their file extension.

| Option                | Type                   | Description                  | Default                         |
| --------------------- | ---------------------- | ---------------------------- | ------------------------------- |
| `templates.path`      | `string`{.type-string} | Path to page template files  | `${%ROOT_PATH%}/site/templates` |
| `templates.extension` | `string`{.type-string} | File extension for templates | `.php`                          |

### Translations

Controls localization by defining fallback language and paths to translation files.

| Option                      | Type                   | Description                 | Default                             |
| --------------------------- | ---------------------- | --------------------------- | ----------------------------------- |
| `translations.fallback`     | `string`{.type-string} | Fallback language code      | `en`                                |
| `translations.paths.panel`  | `string`{.type-string} | Path to panel translations  | `${system.panel.path}/translations` |
| `translations.paths.system` | `string`{.type-string} | Path to system translations | `${%SYSTEM_PATH%}/translations`     |
| `translations.paths.site`   | `string`{.type-string} | Path to site translations   | `${%ROOT_PATH%}/site/translations`  |

### Updates

Handles update checks, downloaded update storage, automatic backup, and cleanup during the update process.

| Option                        | Type                   | Description                                                                               | Default                                                                                                         |
| ----------------------------- | ---------------------- | ----------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------- |
| `updates.time`                | `int`{.type-number}    | Time in seconds between update checks                                                     | `900`                                                                                                           |
| `updates.force`               | `bool`{.type-bool}     | Always check for updates regardless of cache                                              | `false`                                                                                                         |
| `updates.tempFile`            | `string`{.type-string} | Temporary file used for downloaded updates                                                | `${%ROOT_PATH%}/.formwork-update.zip`                                                                           |
| `updates.preferDistAssets`    | `bool`{.type-bool}     | Prefer using pre-built assets when updating                                               | `true`                                                                                                          |
| `updates.backupBefore`        | `bool`{.type-bool}     | Create backup before updating                                                             | `true`                                                                                                          |
| `updates.cleanupAfterInstall` | `bool`{.type-bool}     | Remove temporary files after update                                                       | `true`                                                                                                          |
| `updates.registryFile`        | `string`{.type-string} | Path to updates registry (log file used to keep track of last updates and cache metadata) | `${system.panel.paths.logs}/updates.json`                                                                       |
| `updates.ignore`              | `array`{.type-keyword} | Wildcard patterns to exclude from updates                                                 | [See default config](https://github.com/getformwork/formwork/blob/2.3.14/formwork/config/system.yaml#L156-L160) |

### Uploads

Specifies behavior of file uploads, such as whether to automatically process images.

| Option                  | Type               | Description                               | Default |
| ----------------------- | ------------------ | ----------------------------------------- | ------- |
| `uploads.processImages` | `bool`{.type-bool} | Automatically process images after upload | `true`  |

### Views

Defines view file locations and paths to methods used to render views in both panel and system.

| Option                 | Type                   | Description                            | Default                                         |
| ---------------------- | ---------------------- | -------------------------------------- | ----------------------------------------------- |
| `views.paths.panel`    | `string`{.type-string} | Path to panel view templates           | `${system.panel.path}/views`                    |
| `views.paths.system`   | `string`{.type-string} | Path to core system views              | `${%SYSTEM_PATH%}/views`                        |
| `views.methods.panel`  | `string`{.type-string} | Path to panel view method definitions  | `${system.panel.path}/config/views/methods.php` |
| `views.methods.system` | `string`{.type-string} | Path to system view method definitions | `${%SYSTEM_PATH%}/config/views/methods.php`     |
