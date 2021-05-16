<?php

namespace App\Action\Address;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddressGetListAction extends AddressAction
{
	public function __invoke(ServerRequestInterface $request,
		ResponseInterface $response, array $arguments = []): ResponseInterface
	{
//		$data = $request->getParsedBody();
		
		return $this->responder
			->withJson($response, ['test' => 'getlist'])
			->withStatus(StatusCodeInterface::STATUS_CREATED);
	}
}