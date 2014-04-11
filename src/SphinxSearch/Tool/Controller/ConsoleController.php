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

use SphinxSearch\Tool\Controller\CliTrait;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Config\Config;
use Zend\Config\Factory;

/**
 * Class ConsoleController
 */
class ConsoleController extends AbstractActionController
{
    use CliTrait;


    /**
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     * @return Config
     */
    protected function getConfig()
    {
        $config = $this->params()->fromRoute('config', null);

        if ($config) {
            $toolConfig = $this->getServiceLocator()->get('Config')['sphinxsearch_tool'];
            if (!isset($toolConfig[$config])) {
                throw new \InvalidArgumentException('Config not found with name: ' . $config);
            }
            $config = $toolConfig[$config];
        } else {
            $config = $this->params()->fromRoute('config-file', null);
            if ($config && file_exists($config)) {
                $config = Factory::fromFile($filename, true);
            } else {
                throw new \InvalidArgumentException('Config file not found with name: ' . $config);
            }
        }

        if (empty($config)) {
            throw new \RuntimeException('Invalid configuration');
        }

        return $config;
    }


    /**
     * @return bool
     */
    public function sourceAction()
    {
        echo 'todo source action' . PHP_EOL;
        return false;
    }

    /**
     * @return bool
     */
    public function configAction()
    {

        return false;
    }
}
