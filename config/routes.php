<?php

use App\Action\Address\AddressCreateAction;
use App\Action\Address\AddressDeleteAction;
use App\Action\Address\AddressGetAction;
use App\Action\Address\AddressGetListAction;
use Slim\App;

return function (App $app) {
    $app->post('/address', AddressCreateAction::class);
    $app->get('/address', AddressGetListAction::class);
    $app->get('/address/{address_id}', AddressGetAction::class);
    $app->delete('/address/{address_id}', AddressDeleteAction::class);
};
