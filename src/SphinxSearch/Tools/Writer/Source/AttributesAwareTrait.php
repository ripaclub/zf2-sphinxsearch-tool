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
 * Class AttributesAwareTrait
 */
trait AttributesAwareTrait
{
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Set the source attributes
     *
     * @param $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }
}
