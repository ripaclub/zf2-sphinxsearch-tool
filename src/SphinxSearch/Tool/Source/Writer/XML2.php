<?php
/**
 * zf-sphinxsearch-tool
 *
 * @link        https://github.com/ripaclub/zf2-sphinxsearch-tool
 * @copyright   Copyright (c) 2014,
 *              Leonardo Di Donato <leodidonato at gmail dot com>
 *              Leonardo Grasso <me at leonardograsso dot com>
 * @license     http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */
namespace SphinxSearch\Tool\Source\Writer;

use SphinxSearch\Tool\Source\Exception\NotValidDocumentException;
use SphinxSearch\Tool\Source\Writer\AttributesAwareTrait;
use SphinxSearch\Tool\Source\Writer\FieldsAwareTrait;

/**
 * Class XML2
 * Generate an XML data source suitable for xmlpipe2 driver
 */
class XML2 extends \XMLWriter implements SourceInterface
{
    use FieldsAwareTrait;
    use AttributesAwareTrait;

    protected $options;
    protected $defaultOptions = ['indent' => false, 'indent_string' => "\t"];

    /**
     * Constructor
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->initialize(); // $this->openUri('php://output');
        $this->setOptions($options);
    }

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        // Store the xml tree in memory
        $this->openMemory();
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->defaultOptions, $options);
        $this->setIndent((bool)$this->options['indent']);
        $this->setIndentString((string)$this->options['indent_string']);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function beginOutput()
    {
        $this->startDocument('1.0', 'UTF-8');
        $this->startElement('sphinx:docset');
        $this->startElement('sphinx:schema');
        // Add fields to the schema
        foreach ($this->fields as $fields) {
            $this->startElement('sphinx:field');
            foreach ($fields as $key => $value) {
                $this->writeAttribute($key, $value);
            }
            $this->endElement();
        }
        // Add attributes to the schema
        foreach ($this->attributes as $attributes) {
            $this->startElement('sphinx:attr');
            foreach ($attributes as $key => $value) {
                $this->writeAttribute($key, $value);
            }
            $this->endElement();
        }
        // End sphinx:schema
        $this->endElement();
        print $this->outputMemory();
    }

    /**
     * {@inheritdoc}
     */
    public function addDocument(array $doc)
    {
        $this->startElement('sphinx:document');
        if (!isset($doc['id'])) {
            throw new NotValidDocumentException('Document array must have an element with "id" key');
        }
        $this->writeAttribute('id', $doc['id']);
        foreach ($doc as $key => $value) {
            // Skip the id key since that is an element attribute
            if ($key == 'id') {
                continue;
            }
            $this->startElement($key);
            $this->text($value);
            $this->endElement();
        }
        $this->endElement();
        print $this->outputMemory();
    }

    /**
     * {@inheritdoc}
     */
    public function endOutput()
    {
        // End sphinx:docset
        $this->endElement();
        print $this->outputMemory();
    }
}
