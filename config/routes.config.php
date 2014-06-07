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
return [
    'console' => [
        'router' => [
            'routes' => [
                'sphinxsearch-show-config' => [
                    'options' => [
                        'route' => 'sphinx show config [--file=]',
                        'defaults' => [
                            'controller' => 'SphinxSearch\Tool\Controller\Console\SphinxConfig',
                            'action' => 'show',
                        ],
                    ],
                ],
                'sphinxsearch-print-config' => [
                    'options' => [
                        'route' => 'sphinx print config [--input=] --output= [--nolock]',
                        'defaults' => [
                            'controller' => 'SphinxSearch\Tool\Controller\Console\SphinxConfig',
                            'action' => 'print',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
