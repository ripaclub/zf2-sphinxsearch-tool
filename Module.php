<?php
/**
 * zf2-sphinxsearch-tools
 *
 * @link        https://github.com/ripaclub/zf2-sphinxsearch-tools
 * @copyright   Copyright (c) 2014,
 *              Leonardo Di Donato <leodidonato at gmail dot com>
 *              Leonardo Grasso <me at leonardograsso dot com>
 * @license     http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */
namespace SphinxSearch\Tools;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php',
            ],
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__),
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
