<?php
/**
 * This file is used to set config for database
 * Example
 * + driver = file|mysql|sqlserver
 *     + If driver = file then we need to set path for file
 *     + If dirver = mysql|sqlserver we need to set database configs for mysql|sqlserver
 */
return [
    'driver' => 'file',

    'file' => [
        // Please set permission is read & write for server application for this path
        'path' => 'database' . DIRECTORY_SEPARATOR . 'file'
    ],

    'mysql' => [
        'host' => '',
        'port' => '',
        'dbname' => '',
        'user' => '',
        'password' => ''
    ]
];