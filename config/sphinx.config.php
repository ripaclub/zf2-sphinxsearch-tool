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
    'variables' => [
        'log_path' => '/var/log/sphinx/',
        'lib_path' => '/var/lib/sphinx',
        'run_path' => '/var/run/sphinx/',
        'idx_path' => '/var/idx/sphinx/',
    ],
    'searchd' => [
        'listen' => '9306:mysql41',
        'log' => '{log_path}searchd.log',
        'query_log' => '{log_path}query.log',
        'pid_file' => '{run_path}searchd.pid',
        'workers' => 'threads',
        'binlog_path' => '{lib_path}',
        'sphinxql_state' => '{run_path}state.sql',
    ],
    'indexer' => [
        'mem_limit' => '256M',
        'write_buffer' => '4M',
    ],
    'common' => [
    ],
    'sources' => [
    ],
    'indexes' => [
    ],
];
