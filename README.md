sfSelect2WidgetsPlugin
======================
[![License](https://poser.pugx.org/bgcc/sf-select2-widgets-plugin/license.png)](https://packagist.org/packages/bgcc/sf-select2-widgets-plugin)
[![Total Downloads](https://poser.pugx.org/bgcc/sf-select2-widgets-plugin/downloads.png)](https://packagist.org/packages/bgcc/sf-select2-widgets-plugin)
[![Monthly Downloads](https://poser.pugx.org/bgcc/sf-select2-widgets-plugin/d/monthly.png)](https://packagist.org/packages/bgcc/sf-select2-widgets-plugin)
[![Daily Downloads](https://poser.pugx.org/bgcc/sf-select2-widgets-plugin/d/daily.png)](https://packagist.org/packages/bgcc/sf-select2-widgets-plugin)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/19Gerhard85/sfSelect2WidgetsPlugin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/19Gerhard85/sfSelect2WidgetsPlugin/?branch=master)

Description
-----------
The `sfSelect2WidgetsPlugin` is a symfony 1.2 / 1.3 / 1.4 plugin that provides several form widgets with `Select2` functionality.
Following widgets are included:
  * I18n Choice Country
  * I18n Choice Currency
  * I18n Choice Language
  * Autocomplete (for Doctrine ORM)

Requirements
------------
  * symfony 1.2 / 1.3 / 1.4
  * [jQuery](https://github.com/jquery/jquery), see [Select2](https://github.com/ivaynberg/select2) for the latest supported version

Installation via Composer
-------------------------
```json
{
    "require": {
        "select2/select2": "4.0.*",
        "nicolasf/sf-select2-widgets-plugin": "1.1.*"
    }
}
```

Installation via Git
--------------------
  * Install the plugin and init submodule

        $ git submodule add https://github.com/nicolasfrey/sfSelect2WidgetsPlugin.git plugins/sfSelect2WidgetsPlugin
        $ git submodule update --init --recursive

  * Enable the plugin in your `/config/ProjectConfiguration.class.php`
    ``` php
    $this->enablePlugins('sfSelect2WidgetsPlugin');
    ```
    
  * Clear you cache

        $ ./symfony cc
                
Usage
-----

Update to select2 4.0 in progress. Please don't use. 
