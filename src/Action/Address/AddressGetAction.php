<?php

namespace App\Action\Address;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddressGetAction extends AddressAction
{
	public function __invoke(ServerRequestInterface $request,
		ResponseInterface $response,
		array $arguments = []): ResponseInterface
	{
		$requestedAddressId = (int) $arguments['address_id'];
		$address = $this->addressService->getAddress($requestedAddressId);
		
		return $this->responder
			->withJson($response, $address)
			->withStatus(StatusCodeInterface::STATUS_CREATED);
	}
}