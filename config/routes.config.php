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
                'sphinxsearch-build-source' => [
                    'options' => [
                        'route' => 'source', // 'sphinx build source', // TODO: finish
                        'defaults' => [
                            'controller' => 'SphinxSearch\Tool\Controller\Console',
                            'action' => 'source'
                        ],
                    ],
                ],
                'sphinxsearch-build-config' => [
                    'options' => [
                        'route' => 'config', // TODO: finish
                        'defaults' => [
                            'controller' => 'SphinxSearch\Tool\Controller\Console',
                            'action' => 'config'
                        ],
                    ],
                ],
            ],
        ],
    ],
];
