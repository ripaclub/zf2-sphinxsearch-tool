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
    private static $consoleBannerEnabled = false;

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
        if (file_exists(__DIR__ . '/config/sphinx.config.php')) {
            $moduleConfig['sphinxsearch'] = include __DIR__ . '/config/sphinx.config.php';
        } else {
            if (file_exists(__DIR__ . '/config/sphinx.config.php.dist')) {
                $moduleConfig['sphinxsearch'] = include __DIR__ . '/config/sphinx.config.php.dist';
            }
        }
        $moduleConfig = $this->injectCharsetTableVariables($moduleConfig);
        return $moduleConfig;
    }

    /**
     * Read Sphinx Search charset tables and create variables to expose them
     *
     * @param array $config
     * @return array
     */
    private function injectCharsetTableVariables(array $config)
    {
        if (isset($config['sphinxsearch']) && file_exists(__DIR__ . '/config/sphinx.charset.config.php')) {
            $charsetConfig = include __DIR__ . '/config/sphinx.charset.config.php';
            $languages = $charsetConfig['languages'];
            $defaults = $charsetConfig['defaults'];
            $prefix = 'charset_';
            // Inject default charset table variables
            foreach ($defaults as $name => $table) {
                $config['sphinxsearch']['variables'][$prefix . $name] = $table;
            }
            $default = implode(', ', $defaults);
            $config['sphinxsearch']['variables'][$prefix . 'default'] = $default;
            // Inject language charset table variables
            foreach ($languages as $lang => $table) {
                if (empty($table)) {
                    $config['sphinxsearch']['variables']['charset_' . $lang] = $default;
                } else {
                    $alphanum = '';
                    $alphanum .= $config['sphinxsearch']['variables']['charset_digits'] . ', ';
                    $alphanum .= $config['sphinxsearch']['variables']['charset_alphabet'];
                    $config['sphinxsearch']['variables']['charset_' . $lang] = $alphanum . ', ' . $table;
                }
            }
        }
        return $config;
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
