<?php

/**
 * @url https://github.com/odan/slim4-skeleton/blob/master/config/bootstrap.php
 */

require __DIR__ . '/../vendor/autoload.php';

use DI\ContainerBuilder;
use Slim\App;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(__DIR__ . '/container.php');

$container = $containerBuilder->build();

$app = $container->get(App::class);

// Register routes
(require __DIR__ . '/routes.php')($app);

// Register middleware
(require __DIR__ . '/middleware.php')($app);

return $app;