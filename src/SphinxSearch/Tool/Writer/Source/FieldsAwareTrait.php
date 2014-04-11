<?php
/**
 * zf2-sphinxsearch-tool
 *
 * @link        https://github.com/ripaclub/zf2-sphinxsearch-tool
 * @copyright   Copyright (c) 2014,
 *              Leonardo Di Donato <leodidonato at gmail dot com>
 *              Leonardo Grasso <me at leonardograsso dot com>
 * @license     http://opensource.org/licenses/BSD-2-Clause Simplified BSD Licens
 */
namespace SphinxSearch\Tool\Writer\Source;

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
