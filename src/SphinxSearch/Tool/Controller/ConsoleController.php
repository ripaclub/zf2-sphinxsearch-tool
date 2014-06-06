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
use Zend\Console\Request;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class ConsoleController
 */
class ConsoleController extends AbstractActionController
{
    use CliTrait;
    use ConfigTrait;

    /**
     * @return bool
     */
    public function configAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();
        $filename = $request->getParam('file');
        print_r($this->getConfig($filename));
        return false;
    }

    /**
     * @return bool
     */
    public function sourceAction()
    {
        // TODO: build source
        return false;
    }
}
