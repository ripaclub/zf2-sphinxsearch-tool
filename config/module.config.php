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
    'controllers' => [
        'invokables' => [
            'SphinxSearch\Tool\Controller\Console\SphinxConfig' => 'SphinxSearch\Tool\Controller\Console\SphinxConfigController'
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => false
    ]
];
