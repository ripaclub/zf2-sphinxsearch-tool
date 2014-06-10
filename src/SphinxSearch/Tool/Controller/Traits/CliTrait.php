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

use Zend\Console\Adapter\AdapterInterface as ConsoleAdapter;
use Zend\Console\Exception\RuntimeException as ConsoleRuntimeException;

/**
 * Class CliTrait
 */
trait CliTrait
{
    /**
     * Retrieve the console adapter
     *
     * @return ConsoleAdapter
     * @throws ConsoleRuntimeException
     */
    public function getConsole()
    {
        /** @var ConsoleAdapter $console */
        $console = $this->getServiceLocator()->get('console');
        if (!$console instanceof ConsoleAdapter) {
            throw new ConsoleRuntimeException('Can not obtain a console adapter');
        }
        return $console;
    }
}
