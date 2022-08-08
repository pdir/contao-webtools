# contao-webtools
pdir webtools for contao web development

## Features in this bundle
- **provides a slightly modified** version of the dump() function called pdump() which produces dump output only when the system is in dev mode: APP_ENV=dev. This should curb unwanted or forgotten dumps() somewhat.
- **specifies an additional key** in the query string to delete the assets/css folder from the frontend.
- **add purge button to backend**

## Configuration the purge button

Allow the purge button for all back end users
```
    // .env
    WEBTOOLS_ALLOW_PURGE=true
```

The purge button requires some sources to do its job. They are passed as an array via config.yml. There are
some bundles that provide their own sources (for example the Contao themes from [contao-themes.net](https://contao-themes.net)).
The sources can be set in the bundle configuration:

```
    // config/config.yml
    pdir_webtools:
        purge_sources:
            - files/mate/sass
```

## New functions through dependencies 🛠

- [🔒 Sticky Backend Footer](https://github.com/pdir/contao-sticky-footer/) Placement of the action buttons at the bottom of the screen.

## Purge Script Cache Icon
"zap" from https://feathericons.com/

## Wishlist
- add purge button to preview toolbar
