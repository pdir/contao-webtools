# contao-webtools
pdir webtools for contao web development

## Features in this bundle
- **provides a slightly modified** version of the dump() function called pdump() which produces dump output only when the system is in dev mode: APP_ENV=dev. This should curb unwanted or forgotten dumps() somewhat.
- **specifies an additional key** in the query string to delete the assets/css folder from the frontend.
- **add purge button to backend ![Purge Script Cache](/public/icons/zap.svg?raw=true)**
- **automatically purge script cache in debug mode**

## Configuration the purge button

Allow the purge button for all back end users
```
    // .env
    WEBTOOLS_ALLOW_PURGE=true
```

The purge button purge the script cache like maintenance task "Purge data" do.

## New functions through dependencies 🛠

- [🔒 Sticky Backend Footer](https://github.com/pdir/contao-sticky-footer/) Placement of the action buttons at the bottom of the screen.

## Purge Script Cache Icon
"zap" from https://feathericons.com/

## Wishlist
- add purge button to preview toolbar
