<?php
$app['debug'] = getenv('APPLICATION_DEBUG') == 'true' ?: false;

$app['db.options'] = array(
    'driver'   => getenv('APPLICATION_DB_DRIVE') ? : 'pdo_mysql',
    'dbname'   => getenv('APPLICATION_DB_DBNAME') ? : 'bookApi',
    'host'     => getenv('APPLICATION_DB_HOST') ? : 'localhost:3306',
    'user'     => getenv('APPLICATION_DB_USER') ? : 'root',
    'password' => getenv('APPLICATION_DB_PASSWORD') ? : '4linux',
);
