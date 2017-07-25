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
            "url": "git@code.macherjek.com/mjplug/mj-acf-fields.git"
        }
    },
    "require": {
		"macherjek/wp-acf-fields": "^0.0.1",
	}
```

Notice: Since this a private repository you need a valid public key
to install the plugin

or install it via upload (.zip)


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

A Page Block is intended to loop over custom post types, posts,
page or anything you want. You can choose the Post Type in the checkbox
or choose your own Template. Beware that you need to put your
custom loop templates inside your theme/template-parts/visual-editor/loops
folder. See examples for more information.


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

* 0.0.4
    * Fixed Child Theme override problem
		* Preparing for Updating fields

* 0.0.2/0.0.3
    * Remove theme support require - not needed; commit message

* 0.0.1
	* Work in progress, initial Plugin
