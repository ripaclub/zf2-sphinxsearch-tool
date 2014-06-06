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
namespace SphinxSearch\Tool\Controller\Traits;

use Zend\Config\Config;
use Zend\Config\Factory;

/**
 * Class ConfigTrait
 */
trait ConfigTrait
{
    /**
     * Retrieve the config of sphinxsearch node
     *
     * @param string|null $file
     * @return Config
     */
    protected function getConfig($file = null)
    {
        // Config
        $appConfig = $this->getServiceLocator()->get('Config');

        if (!isset($appConfig['sphinxsearch'])) {
            throw new \InvalidArgumentException('Config not found with name: "sphinxsearch"');
        } else {
            $config = new Config($appConfig['sphinxsearch'], true); // defaults
            if (!is_null($file)) {
                $fileConfig = Factory::fromFile($file, true);
                if (!isset($fileConfig['sphinxsearch'])) {
                    throw new \InvalidArgumentException('Config not found with name: "sphinxsearch"');
                }
                $config->merge($fileConfig['sphinxsearch']);
            }
        }

        return $config;
    }
}
