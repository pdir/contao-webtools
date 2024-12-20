# Changelog

[//]: <> (
Types of changes
    Added for new features.
    Changed for changes in existing functionality.
    Deprecated for soon-to-be removed features.
    Removed for now removed features.
    Fixed for any bug fixes.
    Security in case of vulnerabilities.
)

## [1.6.2](https://github.com/pdir/contao-webtools/tree/1.6.2) - 2024-11-16

- [Fixed] Use local CSS preprocessors

## [1.6.1](https://github.com/pdir/contao-webtools/tree/1.6.1) - 2024-11-06

- [Fixed] Update services.yml to support Contao 5.4

## [1.6.0](https://github.com/pdir/contao-webtools/tree/1.6.0) - 2024-08-01

- [Added] Add compatibility for Contao 5.4+
- [Removed] We removed support for PHP <=8.0

## [1.5.1](https://github.com/pdir/contao-webtools/tree/1.5.1) - 2024-02-26

- [Fixed] Fix display of the backend modules

## [1.5.1](https://github.com/pdir/contao-webtools/tree/1.5.1) - 2022-11-06

- [Fixed] For frontend modules without translation the type is now used

## [1.5.0](https://github.com/pdir/contao-webtools/tree/1.5.0) - 2022-09-30

- [Added] Usability improvement in the backend - Show page, article and module ids by default, disable "Copy" when duplicating

## [1.4.1](https://github.com/pdir/contao-webtools/tree/1.4.1) - 2022-09-29

- [Fixed] PHP warning if WEBTOOLS_ALLOW_PURGE is not set

## [1.4.0](https://github.com/pdir/contao-webtools/tree/1.4.0) - 2022-09-29

- [Added] The hole script cache will automatically be cleared if the debug mode is active.
- [Added] ...the possibility for the frontend user **to delete** the assets/css after modifying files in files/[THEME]/scss. The deletion can be triggered by the additional request key ?**scripts=purge**. The developer editing the modifications via FTP or similar must allow this function with the ENV variable **WEBTOOLS_ALLOW_PURGE=true**. The frontend user now
can add the key **?scripts=purge** like https://mydomain/?scripts=purge to the query string and the cache will be purged. When flushing the script cache is active for frontend users, a new button "![Purge Script Cache](/public/icons/zap.svg?raw=true)" is displayed in the back end header.
- [Removed] Contao 4.9 support

## [1.3.0](https://github.com/pdir/contao-webtools/tree/1.3.0) - 2022-07-14

- [Removed] ⚠ contao-backup-manager. With the new backup command introduced in Contao 4.13, this bundle will not be maintained anymore. Please refer to <https://docs.contao.org/manual/en/cli/db-backups>.
- [Added] use Contao ^4.9 || ^5.0

## [1.2.1](https://github.com/pdir/contao-webtools/tree/1.2.1) – 2021-01-05

- [Changed] Allow PHP 8

## [1.2.0](https://github.com/pdir/contao-webtools/tree/1.2.0) – 2021-10-13

- [Added] use contao-backup-manager version 2
- [Added] set minimum required contao version to 4.9
