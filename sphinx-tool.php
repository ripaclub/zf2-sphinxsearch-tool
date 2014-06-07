#!/usr/bin/env php
<?php
/**
 * zf2-sphinxsearch-tool
 *
 * @link        https://github.com/ripaclub/zf2-sphinxsearch-tool
 * @copyright   Copyright (c) 2014,
 *              Leonardo Di Donato <leodidonato at gmail dot com>
 *              Leonardo Grasso <me at leonardograsso dot com>
 * @license     http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */
$basePath = getcwd();
ini_set('user_agent', 'SphinxSearch Tool');

// load autoloader
if (file_exists("$basePath/vendor/autoload.php")) {
    require_once "$basePath/vendor/autoload.php";
} elseif (file_exists("$basePath/init_autoload.php")) {
    require_once "$basePath/init_autoload.php";
} elseif (\Phar::running()) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    echo 'Error: I cannot find the autoloader of the application.' . PHP_EOL;
    echo "Check if $basePath contains a valid ZF2 application." . PHP_EOL;
    exit(2);
}

if (file_exists("$basePath/config/application.config.php")) {
    $appConfig = require "$basePath/config/application.config.php";
    if (!isset($appConfig['modules']['SphinxSearch\Tool'])) {
        $appConfig['modules'][] = 'SphinxSearch\Tool';
        $appConfig['module_listener_options']['module_paths']['SphinxSearch\Tool'] = __DIR__;
    } else {
        \SphinxSearch\Tool\Module::setConsoleBannerEnabled(false);
    }
} else {
    $appConfig = [
        'modules' => [
            'SphinxSearch\Tool',
        ],
        'module_listener_options' => [
            'config_glob_paths'    => [
                'config/autoload/{,*.}{global,local}.php',
            ],
            'module_paths' => [
                '.',
                './vendor',
            ],
        ],
    ];
}

Zend\Mvc\Application::init($appConfig)->run();