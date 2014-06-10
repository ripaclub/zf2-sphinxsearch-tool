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
use Zend\Filter\Word\SeparatorToSeparator;

/**
 * Class SphinxConf
 */
class SphinxConf extends AbstractWriter
{
    /**
     * @var array
     */
    protected $commands = [
        'searchd'   => 'searchd',
        'indexer'   => 'indexer',
        'common'    => 'common'
    ];

    /**
     * @var array
     */
    protected $sections = [
        'indexes' => 'index',
        'sources' => 'source'
    ];

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
        // Format searchd section options
        $string .= $this->getCommandConfig($config, 'searchd');
        // Format indexer section options
        $string .= $this->getCommandConfig($config, 'indexer');
        // Format common section options
        $string .= $this->getCommandConfig($config, 'common');
        // Format indexes config
        $string .= $this->getSectionConfig($config, 'indexes');
        // Format data source config
        $string .= $this->getSectionConfig($config, 'sources');

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
     * Creates the config part of the specified command
     *
     * @param Config $config
     * @param string $command
     * @return string
     */
    protected function getCommandConfig(Config $config, $command)
    {
        $string = '';
        if (isset($config[$command])) {
            /** @var Config $config */
            $config = $config[$command];
            if ($config->count() > 0) {
                $config = $config->toArray();
                /** @var array $config */
                $string .= $this->commands[$command] . PHP_EOL . '{' . PHP_EOL . "\t";
                $string .= $this->getValuesString($config, true);
                $string .= PHP_EOL . '}' . PHP_EOL;
            }
        }
        return $string;
    }

    /**
     * Construct a string representation from configuration associative values
     *
     * @param array $values
     * @param bool $tab
     * @return string
     */
    private function getValuesString(array $values, $tab = true)
    {
        $glue = $tab ? PHP_EOL . "\t" : PHP_EOL;
        return implode(
            $glue,
            array_map(
                function ($key) use ($values, $glue) {
                    if (!is_array($values[$key])) {
                        $return = $key . ' = ' . $values[$key];
                    } else {
                        $return = implode(
                            $glue,
                            array_map(
                                function ($value) use ($key) {
                                    return $key . ' = ' . $value;
                                },
                                $values[$key]
                            )
                        );
                    }
                    if ($key == 'charset_table') {
                        $filter = new SeparatorToSeparator(', ', ', \\' . $glue);
                        return $filter->filter($return);
                    }
                    return $return;
                },
                array_keys($values)
            )
        );
    }

    /**
     * Creates the config parts of the specified section
     *
     * @param Config $config
     * @param $section
     * @return string
     */
    protected function getSectionConfig(Config $config, $section)
    {
        $string = '';
        if (isset($config[$section])) {
            /** @var Config $config */
            $config = $config[$section];
            // If there is at least one section
            if ($config->count() > 0) {
                /** @var Config $values */
                foreach ($config as $name => $values) {
                    if ($values->count() > 0) {
                        $string .= $this->sections[$section] . ' ' . $name . PHP_EOL . '{' . PHP_EOL . "\t";
                        $string .= $this->getValuesString($values->toArray());
                        $string .= PHP_EOL . '}' . PHP_EOL;
                    }
                }
            }
        }
        return $string;
    }

    /**
     * @param $subject
     * @param string $search
     * @param string $replace
     * @param int $columns
     * @param bool $tab
     * @return mixed|string
     */
    private function cutString($subject, $search = ' ', $replace = PHP_EOL, $columns = 80, $tab = true)
    {
        if (strlen($subject) >= 80) {
            if ($tab) {
                $replace = $replace . "\t";
                return rtrim(str_replace($search, $replace, $subject), "\t");
            } else {
                return str_replace($search, $replace, $subject);
            }
        }
        return $subject;
    }
}
