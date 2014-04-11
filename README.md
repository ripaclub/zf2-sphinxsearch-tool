Sphinx Search Tool [![Analytics](https://ga-beacon.appspot.com/UA-49655829-1/ripaclub/zf2-sphinxsearch-tool)](https://github.com/igrigorik/ga-beacon)
=======================

An utility module that provides a set of tools to configure and handle Sphinx Search engine.

The main purpose is to provide an automated way to build a fully functional and correct Sphinx Search configuration, starting from a ZF2 module configuration file.

It runs from the command line as standalone CLI tool or can be installed as ZF2 module.

## References

- [Sphinx Search configuration options](http://sphinxsearch.com/docs/current.html#conf-reference)

## Requirements
 * Zend Framework 2.0.0 or later.
 * PHP 5.4.0 or later.
 * Console access to the application being maintained (shell, command prompt)

## Installation as standalone using [Composer](http://getcomposer.org)
 1. Open console (command prompt)
 2. `git clone https://github.com/ripaclub/zf2-sphinxsearch-tool.git`
 3. `cd zf2-sphinxsearch-tool`
 4. Run `composer install`
 5. Execute the `sphinx-tool.php`

## Installation as ZF2 module using [Composer](http://getcomposer.org)
 1. Open console (command prompt)
 2. Go to your application's directory.
 3. Run `composer require ripaclub/zf2-sphinxsearch-tool:dev-master`
 4. Execute the `sphinx-tool.php`
