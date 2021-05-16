<?php

namespace App\Action\Address;

use DomainException;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddressGetListAction extends AddressAction
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $arguments = []
    ): ResponseInterface
    {
        $addresses = $this->addressService->getAddresses() ?? [];

        return $this->responder
                ->withJson($response, $addresses)
                ->withStatus(StatusCodeInterface::STATUS_OK);
    }
}
