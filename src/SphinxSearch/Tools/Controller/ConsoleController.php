<?php
/**
 * zf2-sphinxsearch-tools
 *
 * @link        https://github.com/ripaclub/zf2-sphinxsearch-tools
 * @copyright   Copyright (c) 2014,
 *              Leonardo Di Donato <leodidonato at gmail dot com>
 *              Leonardo Grasso <me at leonardograsso dot com>
 * @license     http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */
namespace SphinxSearch\Tools\Controller;

use SphinxSearch\Tools\Controller\CliTrait;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Class ConsoleController
 */
class ConsoleController extends AbstractActionController
{
    use CliTrait;
}
