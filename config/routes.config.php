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

return [
    'console' => [
        'router' => [
            'routes' => [
                'sphinxsearch-build-source' => [
                    'options' => [
                        'route' => 'sphinx build source', // TODO: finish
                        'defaults' => [
                            'controller' => 'SphinxSearch\Tools\Controller\Console',
                            'action' => 'source'
                        ],
                    ],
                ],
                'sphinxsearch-build-config' => [
                    'options' => [
                        'route' => 'sphinx build config', // TODO: finish
                        'defaults' => [
                            'controller' => 'SphinxSearch\Tools\Controller\Console',
                            'action' => 'config'
                        ],
                    ],
                ],
            ],
        ],
    ],
];
