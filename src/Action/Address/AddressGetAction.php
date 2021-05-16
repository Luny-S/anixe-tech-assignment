<?php

namespace App\Action\Address;

use DomainException;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddressGetAction extends AddressAction
{
	public function __invoke(ServerRequestInterface $request,
		ResponseInterface $response,
		array $arguments = []): ResponseInterface
	{
		$requestedAddressId = (int)$arguments['address_id'];
		
		try {
			$address = $this->addressService->getAddress($requestedAddressId);
			
			return $this->responder
				->withJson($response, $address)
				->withStatus(StatusCodeInterface::STATUS_OK);
		} catch (DomainException $exception) {
			return $this->responder
				->withJson($response,
					['error' => $exception->getMessage()])
				->withStatus(StatusCodeInterface::STATUS_NOT_FOUND);
			
		}
	}
}