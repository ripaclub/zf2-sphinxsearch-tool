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
namespace SphinxSearch\Tool\Writer\Source;

/**
 * Interface SourceInterface
 */
interface SourceInterface
{
    /**
     * Open the memory
     */
    public function initialize();

    /**
     * Create new data source using URI for output
     *
     * @param $uri
     * @return bool TRUE on success or FALSE on failure
     */
    public function openUri($uri);

    /**
     * Begin the data source file
     *
     * @return string The current buffer as a string
     */
    public function beginOutput();

    /**
     * Add a document to the data source
     * If the document does not contain an identifier (i.e., element with id key) it throws an exception
     *
     * @param array $doc
     * @throws \SphinxSearch\Tool\Writer\Exception\NotValidDocumentException
     * @return string The current buffer as a string
     */
    public function addDocument(array $doc);

    /**
     * End the data source file
     *
     * @return string The current buffer as a string
     */
    public function endOutput();
}
