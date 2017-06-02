<?php
$app['debug'] = getenv('APPLICATION_DEBUG') == 'true' ?: false;

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'dbname'   => getenv('APPLICATION_DB_DBNAME')   ? : 'example',
    'host'     => getenv('APPLICATION_DB_HOST')     ? : 'localhost',
    'user'     => getenv('APPLICATION_DB_USER')     ? : 'root',
    'password' => getenv('APPLICATION_DB_PASSWORD') ? : '123456789',
);
