<?php

use App\Middleware\UserPersistance\UserPersistanceMiddleware;
use Psr\Container\ContainerInterface;
use Slim\App;

return function (App $app, ContainerInterface $container) {
	$app->addBodyParsingMiddleware();
	$app->add($container->get(UserPersistanceMiddleware::class));
};