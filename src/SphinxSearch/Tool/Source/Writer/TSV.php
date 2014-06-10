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
     */
    public function __construct()
    {
        $this->openURI('php://output');
    }

    /**
     * {@inheritdoc}
     */
    public function openURI($uri)
    {
        $this->handle = fopen($uri, 'w');
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
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function addDocument(array $doc)
    {
        if (!isset($doc['id'])) {
            throw new NotValidDocumentException('Document array must have an element with "id" key');
        }
        ob_start();
        $len = fputcsv($this->handle, $doc, "\t");
        if ($len === false) {
            throw new \RuntimeException('Error writing document');
        }
        return ob_get_clean();
    }

    /**
     * {@inheritdoc}
     */
    public function endOutput()
    {
        fclose($this->handle);
        return '';
    }
}
