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
namespace SphinxSearch\Tool\Source\Writer;

/**
 * Class TSV
 *
 */
class TSV implements SourceInterface
{
    // TODO: see function fputcsv http://php.net/manual/en/function.fputcsv.php
    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function openURI($uri)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function beginOutput()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function addDocument(array $doc)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function endOutput()
    {
    }
}
