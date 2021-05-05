# ComposerInstaller
A composer plugin to install CORE-POS plugins in correct directories.

# Usage
To create a Lane plugin, use `corepos-lane-plugin` for the `type` in
your `composer.json` file. To create an Office plugin use
`corepos-office-plugin` for the `type` in your `composer.json` file.

# Name Mangling
The installer rewrites package names to translate from composer naming
conventions to CORE's. The author/vendor directory layer is omitted
and hyphenated names are converted to camelCase.

Ex: `gohanman/my-core-plugin` will install into a directory named
`MyCorePlugin`.

There are two special cases: if a package's name starts with
`lane-plugin` or `office-plugin` those words are omitted.
So `gohanman/lane-plugin-foo-bar` will install into a directory
named `FooBar`.
