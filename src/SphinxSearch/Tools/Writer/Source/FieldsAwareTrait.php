<?php
/**
 * zf2-sphinxsearch-tools
 *
 * @link        https://github.com/ripaclub/zf2-sphinxsearch-tools
 * @copyright   Copyright (c) 2014,
 *              Leonardo Di Donato <leodidonato at gmail dot com>
 *              Leonardo Grasso <me at leonardograsso dot com>
 * @license     http://opensource.org/licenses/BSD-2-Clause Simplified BSD Licens
 */
namespace SphinxSearch\Tools\Writer\Source;

/**
 * Class FieldsAwareTrait
 */
trait FieldsAwareTrait
{
    /**
     * @var array
     */
    protected $fields = [];

    /**
     * Set the source fields
     *
     * @param $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }
}
