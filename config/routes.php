<?php


use Slim\App;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

return function (App $app) {

	
	$app->get('/', function (Request $request, Response $response, $args) {
		$response->getBody()->write("Hello world!");
		
		return $response;
	});
};

