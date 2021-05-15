<?php

use App\Middleware\UserPersistance\UserPersistanceMiddleware;
use Slim\App;

return function (App $app) {
	$app->add(new UserPersistanceMiddleware());
};