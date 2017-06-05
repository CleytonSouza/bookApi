<?php
/*
| -------------------------------------------------------------------
|  BOOK_API_ROOT_PATH
| -------------------------------------------------------------------
*/
defined('BOOK_API_ROOT_PATH')
|| define('BOOK_API_ROOT_PATH', realpath(dirname(__DIR__)));

/*
| -------------------------------------------------------------------
|  COMPOSER AUTOLOAD VENDOR/AUTOLOAD.php
| -------------------------------------------------------------------
*/
require_once BOOK_API_ROOT_PATH.'/vendor/autoload.php';

/*
| -------------------------------------------------------------------
|  APPLICATION
| -------------------------------------------------------------------
*/
$app = new Silex\Application();

/*
| -------------------------------------------------------------------
|  ErrorHandler
| -------------------------------------------------------------------
*/
use WhoopsSilex\WhoopsServiceProvider;
$app->register(new WhoopsServiceProvider);

/*
| -------------------------------------------------------------------
|  Serializer
| -------------------------------------------------------------------
*/
use Silex\Provider\SerializerServiceProvider;
$app->register(new SerializerServiceProvider());

/*
| -------------------------------------------------------------------
|  ROUTING
| -------------------------------------------------------------------
*/
$app->mount('/books', new BookApi\Controller\Book());
$app->mount('/authors', new BookApi\Controller\Author());
$app->mount('/publishers', new BookApi\Controller\Publisher());

/*
| -------------------------------------------------------------------
|  RUNNING
| -------------------------------------------------------------------
*/
$app->run();
