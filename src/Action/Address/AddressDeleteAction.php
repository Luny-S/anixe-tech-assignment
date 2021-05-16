<?php

namespace App\Action\Address;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddressDeleteAction extends AddressAction
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $arguments = []
    ): ResponseInterface {
        $requestedAddressId = (int)$arguments['address_id'];

        $this->addressService->deleteAddress($requestedAddressId);

        return $this->responder->createResponse()->withStatus(StatusCodeInterface::STATUS_OK);
    }
}
