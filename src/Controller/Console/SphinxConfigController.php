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
use SphinxSearch\Tool\Source\Writer\TSV;
use SphinxSearch\Tool\Source\Writer\XML2;
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
        $config = array_filter($this->getConfig($filename)->toArray());
        // Show configuration
        $console = $this->getConsole();

        return var_export($config) . PHP_EOL;
    }

    /**
     * @return bool
     */
    public function printAction()
    {
        // Retrieve parameters
        /** @var Request $request */
        $request = $this->getRequest();
        $input = $request->getParam('input');
        $output = $request->getParam('output');
        $elock = !$request->getParam('nolock', false);
        // Retrieve configuration
        $config = array_filter($this->getConfig($input)->toArray());
        // Write configuration
        $writer = new SphinxConf();
        $writer->toFile($output, $config, $elock);

        return false;
    }

    public function testTsvAction()
    {
        $data = [
            ['id' => '1', 'name' => 'ciao', 'a' => 'mondo'],
            ['id' => '2', 'name' => 'hello', 'a' => 'world']
        ];
        $writer = new TSV();
        $writer->openURI('tsv.tsv');
        echo $writer->beginOutput();
        foreach ($data as $doc) {
            echo $writer->addDocument($doc);
            sleep(5);
        }
        echo $writer->endOutput();
    }

    public function testXMLAction()
    {
        $data = [
            ['id' => '1', 'name' => 'ciao', 'a' => 'mondo'],
            ['id' => '2', 'name' => 'hello', 'a' => 'world']
        ];
        $writer = new XML2();
        $writer->openUri('xml.xml');
        $writer->setFields(
            [
                ['name' => 'name']
            ]
        );
        $writer->setAttributes(
            [
                ['name' => 'a', 'type' => 'string']
            ]
        );
        echo $writer->beginOutput();
        foreach ($data as $doc) {
            echo $writer->addDocument($doc);
            sleep(5);
        }
        echo $writer->endOutput();
    }

}
