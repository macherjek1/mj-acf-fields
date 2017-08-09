# MJ-ACF-Fields
> This plugin gives you prefedefined page-blocks which you can use with ACF Grid Layout. It works well with our mjtheme


## Installation

If you use our mjstack (mjbedrock, mjtheme, mjtheme-child) you don't need to
include this plugin manually since its built in within the mjbedrock/composer.json
file.

Composer:

```json
	"repositories": {
        "mj-acf-fields": {
            "type": "vcs",
            "url": "git@github.com/macherjek1/mj-acf-fields.git"
        }
    },
    "require": {
		"macherjek/wp-acf-fields": "~1.0.0",
	}
```

## Usage

You can find predefined Page Blocks inside the templates folder which
gives you the ability to Build your own Page Layout with ACF Grid Layout.


### Use your own Templates

If you wan't to override a template for your own needs just
create a folder inside your theme named template-parts/visual-editor.

For example if you want to create your own Title Block
create a file named title-block inside the visual-editor folder.

```
	- mjtheme-child
	-- template-parts

	---- visual-editor
	----- title-block.php
	----- other-page-block.php

	----- custom
	------- custom-page-block.php
```

This should also work in your parent theme (if you don't use
a child Theme)



## Included Page Blocks

### Content Block

_Filename_: content-block.php

@TODO Add Description

### Image Block

@TODO Add Description

### Page Block

'Page Blocks' give you the ability to extend the default
page blocks with custom logic.

Since we just give you a bunch of predefined Blocks you can your
own Blocks without any needed Fields. (If you need a Page Block
with fields you need to create anyway your own).

Put your Custom Page Blocks into the ``theme/template-parts/visual-editor/loops``
folder.

You could also choose a custom Post Type from the list which you want
to loop over

_Filename_: page-block.php

### Price Table

@TODO Add Description

### Shortcode

@TODO Add Description

### Title Block

@TODO Add Description

### Video Block

@TODO Add Description

## Release History

* 1.0.2
	Removed Bitbucket Server. Added Github.

* 1.0.1
	* Rename `loop`Folder to `custom`!

* 1.0.0
	* Release

* 0.0.9
	* Removing Files in root

* 0.0.8
	* Fixes

* 0.0.7
	* Move to subdirectory according to update rules
	* Allow unsafe urls (due 7990 port)

* 0.0.6
	Bugfixing for Autoupdate

* 0.0.5
	* Fixed some Page Blocks
	* Auto Updater Feature
	* Allow Import/Export fields via MJTheme Panel

* 0.0.4
 * Fixed Child Theme override problem
 * Preparing for Updating fields

* 0.0.3
	* Some fixes

* 0.0.2
    * Remove theme support require - not needed; commit message

* 0.0.1
	* Work in progress, initial Plugin
