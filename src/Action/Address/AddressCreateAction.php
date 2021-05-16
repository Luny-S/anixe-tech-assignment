<?php

namespace App\Action\Address;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Selective\Validation\Exception\ValidationException;

final class AddressCreateAction extends AddressAction
{
	public function __invoke(
		ServerRequestInterface $request,
		ResponseInterface $response,
		array $arguments = []
	): ResponseInterface
	{
		$data = $request->getParsedBody();
		
		try {
			$entityId = $this->addressService->createAddress($data);
			return $this->responder
				->withJson($response, ['id' => $entityId])
				->withStatus(StatusCodeInterface::STATUS_CREATED);
		} catch (ValidationException $exception) {
			return $this->responder
				->withJson($response,
					['error' => $exception->getMessage() . " [ INFO: Validation exception parsing is not implemented yet ]"])
				->withStatus(StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY);
		}
		
		
	}
}