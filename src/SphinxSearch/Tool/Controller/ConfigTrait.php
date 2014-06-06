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
namespace SphinxSearch\Tool\Controller;

use Zend\Config\Config;
use Zend\Config\Factory;

/**
 * Class ConfigTrait
 */
trait ConfigTrait
{
    /**
     * @param string|null $file
     * @return Config
     */
    protected function getConfig($file = null)
    {
        // Config
        $appConfig = $this->getServiceLocator()->get('Config');

        if (!isset($config['sphinxsearch'])) {
            throw new \InvalidArgumentException('Config not found with name: ' . $config);
        } else {
            $config = new Config([], true);
            $config->merge($config['sphinxsearch']); //defaults

            if (!is_null($file)) {
                $fileConfig = Factory::fromFile($file, true);
                $config->merge($fileConfig);
            }
        }

        return $config;
    }
}
