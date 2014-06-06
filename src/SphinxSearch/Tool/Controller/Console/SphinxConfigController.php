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
namespace SphinxSearch\Tool\Controller\Console;

use SphinxSearch\Tool\Config\Writer\SphinxConf;
use SphinxSearch\Tool\Controller\Traits\CliTrait;
use SphinxSearch\Tool\Controller\Traits\ConfigTrait;
use Zend\Console\Request;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class SphinxConfigController
 */
class SphinxConfigController extends AbstractActionController
{
    use CliTrait;
    use ConfigTrait;

    /**
     * @return mixed
     */
    public function showAction()
    {
        // Retrieve parameters
        /** @var Request $request */
        $request = $this->getRequest();
        $filename = $request->getParam('file');
        // Retrieve configuration
        $config = $this->getConfig($filename)->toArray();
        // Show configuration
        $console = $this->getConsole();
        return var_export($config) . PHP_EOL;
    }

    /**
     * TODO: add exclusive lock
     * TODO: force filename parameter
     * @return bool
     */
    public function printAction()
    {
        // Retrieve parameters
        /** @var Request $request */
        $request = $this->getRequest();
        $filename = $request->getParam('file');
//        $elock = $request->getParam('elock');
        // Retrieve configuration
        $config = $this->getConfig($filename)->toArray();
        // Write configuration
        $writer = new SphinxConf();
        echo $writer->processConfig($config);
//        $writer->toFile($filename, $config);


        return false;
    }
}
