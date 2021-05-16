<?php

/**
 * Factories to make certan classes. Simplified version of:
 * @url https://github.com/odan/slim4-skeleton/blob/master/config/container.php
 */

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Cake\Database\Connection;
use App\Middleware\UserPersistance\UserPersistanceMiddleware;

return [
	'settings' => function () {
		return require __DIR__ . '/settings.php';
	},
	
	UserPersistanceMiddleware::USER_COOKIE_NAME => function () {
		return null;
	},
	
	App::class => function (ContainerInterface $container) {
		AppFactory::setContainer($container);
		
		return AppFactory::create();
	},
	
	ResponseFactoryInterface::class => function (ContainerInterface $container) {
		return $container->get(App::class)->getResponseFactory();
	},
	
	Connection::class => function (ContainerInterface $container) {
		return new Connection($container->get('settings')['db']);
	},
	
	PDO::class => function (ContainerInterface $container) {
		$db = $container->get(Connection::class);
		$driver = $db->getDriver();
		$driver->connect();
		
		return $driver->getConnection();
	},
];