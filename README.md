Sphinx Search Tool
==================

![Help message](help-img.png "Help message")

An utility that provides a set of tools to configure and handle Sphinx Search configurations and sources.

The main purpose is to provide an automated way to build a Sphinx Search configuration starting from a ZF2 configuration file.

It runs from the command line as standalone CLI tool or can be installed as a ZF2 module.

## References

- [Sphinx Search configuration options](http://sphinxsearch.com/docs/current.html#conf-reference)

## Requirements
 * Zend Framework 2.0.0 or later
 * PHP 5.4.0 or later
 * Console access to the application being maintained (shell, command prompt)

## Installation

### Standalone installation using [Composer](http://getcomposer.org)

 1. Open console (command prompt)
 2. `git clone https://github.com/ripaclub/zf2-sphinxsearch-tool.git`
 3. `cd zf2-sphinxsearch-tool`
 4. Run `composer install`

### Installation as ZF2 module using [Composer](http://getcomposer.org)

 1. Open console (command prompt)
 2. Go to your application's directory
 3. Add the following to your **composer.json**

```json
{
    ...,
    "require": {
        "ripaclub/zf2-sphinxsearch-tool": "dev-develop"
    },
    "repositories": [
        {
        "type": "vcs",
        "url": "https://github.com/ripaclub/zf2-sphinxsearch-tool.git"
        }
    ]
}
```

 4. Run a `composer update`

## Usage

The entry point of the tool is the `sphinx-tool.php` file.

So executing it without commands, i.e. `php -f sphinx-tool.php`, the help message will be shown.

The usage of this tool is self-explanatory.

You can output (as array) to your console the Sphinx Search settings stored in the ZF2 configuration files (e.g. `module.config.php`) or in an external configuration file (e.g. `sphinx.conf.php`).

The Sphinx Search settings here specified will be merged with the default settings contained in ZF2 Sphinx Search Tool.

`php -f sphinx-tool.php show config`

`php -f sphinx-tool.php show config --file=sphinx.conf.php`

Also, you can directly write the configuration in the Sphinx Search format.

`php -f sphinx-tool.php print config --output=config/sphinx.dev.conf`

`php -f sphinx-tool.php print config --input=sphinx.conf.php --output=config/sphinx.dev.conf`

### Configuration examples

...

### Create data sources

...

---

[![Analytics](https://ga-beacon.appspot.com/UA-49655829-1/ripaclub/zf2-sphinxsearch-tool)](https://github.com/igrigorik/ga-beacon)
