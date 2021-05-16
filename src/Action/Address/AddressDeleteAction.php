<?php

namespace App\Action\Address;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AddressDeleteAction extends AddressAction
{
	public function __invoke(ServerRequestInterface $request,
		ResponseInterface $response): ResponseInterface
	{
//		$data = $request->getParsedBody();
		
		return $this->responder
			->withJson($response, ['test' => 'delete'])
			->withStatus(StatusCodeInterface::STATUS_CREATED);
	}
}