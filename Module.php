<?php
/**
 * zf2-sphinxsearch-tool
 *
 * @link        https://github.com/ripaclub/zf2-sphinxsearch-tools
 * @copyright   Copyright (c) 2014,
 *              Leonardo Di Donato <leodidonato at gmail dot com>
 *              Leonardo Grasso <me at leonardograsso dot com>
 * @license     http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */
namespace SphinxSearch\Tool;

use Zend\Console\Adapter\AdapterInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Text\Figlet\Figlet;

/**
 * Class Module
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ConsoleBannerProviderInterface,
    ConsoleUsageProviderInterface
{
    /**
     * @var bool
     */
    private static $consoleBannerEnabled = true;

    /**
     * @param bool $enable
     */
    public static function setConsoleBannerEnabled($enable = true)
    {
        static::$consoleBannerEnabled = $enable;
    }

    /**
     * {@inheritdoc}
     */
    public function getAutoloaderConfig()
    {
        return [
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
        $moduleConfig = include __DIR__ . '/config/module.config.php';
        $moduleConfig = array_merge($moduleConfig, include __DIR__ . '/config/routes.config.php');
        if (file_exists(__DIR__ . '/config/sphinxsearch.config.php')) {
            $moduleConfig['sphinxsearch'] = include __DIR__ . '/config/sphinxsearch.config.php';
        } else if (file_exists(__DIR__ . '/config/sphinxsearch.config.php.dist')) {
            $moduleConfig['sphinxsearch'] = include __DIR__ . '/config/sphinxsearch.config.php.dist';
        }
        return $moduleConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function getConsoleBanner(AdapterInterface $console)
    {
        if (static::$consoleBannerEnabled) {
            $figlet = new Figlet(['font' => __DIR__ . '/assets/font/colossal.flf']);
            $figlet->setOutputWidth($console->getWidth());
            $figlet->setJustification(Figlet::JUSTIFICATION_CENTER);
            return PHP_EOL . $figlet->render('Sphinx Search Tool');
        } else {
            return '';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getConsoleUsage(AdapterInterface $console)
    {
        return [
            'sphinx show config [--file=]' => 'Print to standard output the SphinxSearch settings',
            ['[--file=]', 'The path of a ZF2 config file containing SphinxSearch settings (optional)'],
            'sphinx print config [--input=] --output= [--nolock]' => 'Write a SphinxSearch configuration file',
            ['[--input=]', 'The path of a ZF2 config file containing SphinxSearch settings (optional)'],
            ['--output=', 'The path of the output .conf file'],
            ['[--nolock]', 'Wheter to write with exclusive lock or not (default true, optional)']
        ];
    }
}
