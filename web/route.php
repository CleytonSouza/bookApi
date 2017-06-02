<?php

//Definição das principais rotas do projeto

require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
//require'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\JsonResponse;

$app = new Silex\Application();




//>>>>BOOKS

//Rota GET /books
$app->get('/books',function(){

	return new JsonResponse('Rota /books', 200);

});


//Rota GET /books/isbn/{isbn}
$app->get('/books/isbn/{isbn}', function($isbn){

	return new JsonResponse('Rota /books/isbn'. $isbn . ' ', 200);
	
});


//Rota POST /books
$app->post('/books', function(){

	return new JsonResponse('Rota Recebida /books', 200);

});


//Rota PUT /books
$app->put('/books', function(){

	return new JsonResponse('Rota Atualizada /books', 200);

});


//Rota DELETE /books/isbn/{isbn}
$app->delete('/books/isbn/{isbn}', function($isbn){

	return new JsonResponse('Rota Excluida /books/isbn'. $isbn . ' ', 200);
	
});








//>>>>>>AUTHOR

//Rota GET /author
$app->get('/author',function(){

	return new JsonResponse('Rota /author', 200);

});

//Rota GET /author/name/{name}
$app->get('/author/name/{name}', function($name){

	return new JsonResponse('Rota /author/name'. $isbn . ' ', 200);
	
});

//Rota POST /author
$app->post('/author', function(){

	return new JsonResponse('Rota Recebida /author', 200);

});


//Rota PUT /author
$app->put('/author', function(){

	return new JsonResponse('Rota Atualizada /author', 200);

});

//Rota DELETE /author/name/{name}
$app->delete('/author/name/{name}', function($name){

	return new JsonResponse('Rota Excluida /author/name'. $isbn . ' ', 200);
	
});









//>>>>>PUBLISHER

//Rota GET /publisher
$app->get('/publisher',function(){

	return new JsonResponse('Rota /publisher', 200);

});

//Rota GET /publisher/name/{name}
$app->get('/publisher/name/{name}', function($name){

    return new JsonResponse('Rota /publisher/name'. $isbn . '', 200);
	
});

//Rota POST //publisher
$app->post('/publisher', function(){

	return new JsonResponse('Rota Recebida /publisher', 200);

});


//Rota PUT /publisher
$app->put('/publisher', function(){

	return new JsonResponse('Rota Atualizada /publisher', 200);

});

//Rota DELETE /publisher/name/{name}
$app->delete('/publisher/name/{name}', function($name){

	return new JsonResponse('Rota Excluida /publisher/name'. $isbn . ' ', 200);
	
});
























