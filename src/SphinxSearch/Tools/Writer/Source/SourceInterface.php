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
namespace SphinxSearch\Tools\Writer\Source;

/**
 * Interface SourceInterface
 */
interface SourceInterface
{
    /**
     * Create the data source instance
     *
     * @param array $options
     */
    public function __construct($options = []);

    /**
     * Create new data source using URI for output
     *
     * @param $uri
     * @return bool TRUE on success or FALSE on failure
     */
    public function openURI($uri);

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
     * @throws \SphinxSearch\Tools\Writer\Exception\NotValidDocumentException
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
