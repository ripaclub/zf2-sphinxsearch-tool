Sphinx Search Tool [![Analytics](https://ga-beacon.appspot.com/UA-49655829-1/ripaclub/zf2-sphinxsearch-tool)](https://github.com/igrigorik/ga-beacon)
=======================

An utility that provides a set of tools to configure and handle Sphinx Search engine.

The main purpose is to provide an automated way to build a fully functional and correct Sphinx Search configuration, starting from a ZF2 module configuration file.

It runs from the command line as standalone CLI tool or can be installed as a ZF2 module.

## References

- [Sphinx Search configuration options](http://sphinxsearch.com/docs/current.html#conf-reference)

## Requirements
 * Zend Framework 2.0.0 or later
 * PHP 5.4.0 or later
 * Console access to the application being maintained (shell, command prompt)

## Standalone installation using [Composer](http://getcomposer.org)
 1. Open console (command prompt)
 2. `git clone https://github.com/ripaclub/zf2-sphinxsearch-tool.git`
 3. `cd zf2-sphinxsearch-tool`
 4. Run `composer install`
 5. Execute the `sphinx-tool.php`

## Installation as ZF2 module using [Composer](http://getcomposer.org)
 1. Open console (command prompt)
 2. Go to your application's directory.
 3. Add the following to your composer.json


 ```json
"require": {
    "ripaclub/zf2-sphinxsearch-tool": "dev-develop"
}
```

```json
"repositories": {
        {                                                                                                                                                                                                      
            "type": "vcs",
            "url": "https://github.com/ripaclub/zf2-sphinxsearch-tool.git"
        }
}
 ```

 4. Run a `composer update`
 5. Execute the `sphinx-tool.php`
