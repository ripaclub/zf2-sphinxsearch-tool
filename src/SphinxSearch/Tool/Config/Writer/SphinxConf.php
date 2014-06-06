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
namespace SphinxSearch\Tool\Config\Writer;

use Zend\Config\Config;
use Zend\Config\Processor\Token;
use Zend\Config\Writer\AbstractWriter;

/**
 * Class SphinxConf
 */
class SphinxConf extends AbstractWriter
{
    /**
     * @param array $config
     * @return string
     */
    public function processConfig(array $config)
    {
        $string = '';
        $config = new Config($config, true);
        // Substitute variables
        $config = $this->substituteVars($config);
        // Format searchd deamon config
        $string .= $this->getCommandConf($config, 'searchd');
        // Format indexer command config
        $string .= $this->getCommandConf($config, 'indexer');
        // TODO: Format indexes config

        return $string;
    }

    /**
     * Substitute defined variables, if any found and return the new configuration object
     *
     * @param Config $config
     * @param string $prefix
     * @param string $suffix
     * @return Config
     */
    protected function substituteVars(Config $config, $prefix = '{', $suffix = '}')
    {
        $arrayConfig = $config->toArray();
        if (isset($arrayConfig['variables'])) {
            $vars = array_map(
                function ($x) use ($prefix, $suffix) {
                    return $prefix . $x . $suffix;
                },
                array_keys($arrayConfig['variables'])
            );
            $vals = array_values($arrayConfig['variables']);
            $tokens = array_combine($vars, $vals);
            $processor = new Token();
            $processor->setTokens($tokens);
            $processor->process($config);
            // Remove variables node
            unset($config->variables);
        }
        return $config;
    }

    /**
     * @param Config $config
     * @param string $command
     * @return string
     */
    protected function getCommandConf(Config $config, $command)
    {
        $string = '';
        if (isset($config[$command])) {
            /** @var Config $conf */
            $conf = $config[$command];
            if ($conf->count() > 0) {
                $conf = $conf->toArray();
                /** @var array $conf */
                $string .= $command . PHP_EOL . '{' . PHP_EOL;
                $string .= implode(
                    PHP_EOL,
                    array_map(
                        function ($key) use ($conf) {
                            return $key . ' = ' . $conf[$key];
                        },
                        array_keys($conf)
                    )
                );
                $string .= PHP_EOL . '}' . PHP_EOL;
            }
        }
        return $string;
    }

} 