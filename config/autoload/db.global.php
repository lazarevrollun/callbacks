<?php
/**
 * @copyright Copyright © 2014 Rollun LC (http://rollun.com/)
 * @license LICENSE.md New BSD License
 */

use Laminas\Db\Adapter\AdapterInterface;

return [
    'dependencies' => [
        'aliases' => [
            'db' => AdapterInterface::class,
        ],
    ],
    'dataStore' => [
        'dataStore' => [
            'class' => \rollun\datastore\DataStore\DbTable::class,
            'tableName' => 'orders',
            'dbAdapter' => 'db', // service name, optional
            'sqlQueryBuilder' => 'sqlQueryBuilder'  // service name, optional
        ],
    ],
    'db' => [
        'driver' => getenv('DB_DRIVER') ?: 'Pdo_Mysql',
        'database' => getenv('DB_NAME'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASS'),
        'hostname' => getenv('DB_HOST'),
        'port' => getenv('DB_PORT') ?: 3306,
    ],
];
