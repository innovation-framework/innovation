<?php
/**
 * This file is used to set configs for this application
 * Example
 * + Timeout session in this application is 7200 seconds
 * + Page size for all list pages are 3
 */
return [
    'session' => [
        'timeout' => 7200 // timeout is seconds
    ],
    'pageSize' => 3,
    'storagePath' => [
        'root' => APP_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'storage',
        'logs' => APP_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs'
    ],
    'logs' => [
        'errors' => [
            'path' => APP_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs',
            'file' => 'errors',
            'frequency' => 'daily'
        ],
        'warnings' => [
            'path' => APP_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'logs',
            'file' => 'warnings',
            'frequency' => 'monthly'
        ]
    ]
];