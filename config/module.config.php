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
    'service_manager' => [
        'invokable' => [
            'SphinxSearch\Tools\Controller\Console' => 'SphinxSearch\Tools\Controller\ConsoleController'
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => false
    ]
];
