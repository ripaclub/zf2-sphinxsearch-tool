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

use Zend\Console\Adapter\AdapterInterface;
use Zend\Console\Console;
use Zend\Console\Exception\RuntimeException as ConsoleRuntimeException;

/**
 * Class CliTrait
 */
trait CliTrait
{
    /**
     * Retrieves the console adapter
     *
     * @return AdapterInterface
     * @throws \RuntimeException
     */
    public function getConsole()
    {
        /** @var AdapterInterface $console */
        $console = $this->getServiceLocator()->get('console');
        if (!$console instanceof Console) {
            throw new ConsoleRuntimeException('Can not obtain a console adapter');
        }
        return $console;
    }
}
