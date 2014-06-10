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

use SphinxSearch\Tool\Source\Exception\NotValidDocumentException;

/**
 * Class TSV
 *
 */
class TSV implements SourceInterface
{
    /**
     * @var resource
     */
    protected $handle;

    /**
     * Constructor
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->initialize();
    }

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        $this->openURI('php://output');
    }

    /**
     * {@inheritdoc}
     */
    public function openURI($uri)
    {
        $this->handle = fopen($uri, 'wb');
        if (!$this->handle) {
            return false;
        } else {
            return true;
        }
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
        if (!isset($doc['id'])) {
            throw new NotValidDocumentException('Document array must have an element with "id" key');
        }
//        fputcsv()
    }

    /**
     * {@inheritdoc}
     */
    public function endOutput()
    {
    }
}
