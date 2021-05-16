<?php

/**
 * Simplified version of:
 * @url https://github.com/odan/slim4-skeleton/blob/master/src/Responder/Responder.php
 */

namespace App\Responder;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use function http_build_query;

/**
 * A generic responder.
 */
final class Responder
{
	private ResponseFactoryInterface $responseFactory;
	
	/**
	 * The constructor.
	 *
	 * @param ResponseFactoryInterface $responseFactory The response factory
	 */
	public function __construct(
		ResponseFactoryInterface $responseFactory
	) {
		$this->responseFactory = $responseFactory;
	}
	
	/**
	 * Create a new response.
	 *
	 * @return ResponseInterface The response
	 */
	public function createResponse(): ResponseInterface
	{
		return $this->responseFactory->createResponse()->withHeader('Content-Type', 'text/html; charset=utf-8');
	}
	
	/**
	 * Write JSON to the response body.
	 *
	 * This method prepares the response object to return an HTTP JSON
	 * response to the client.
	 *
	 * @param ResponseInterface $response The response
	 * @param mixed $data The data
	 * @param int $options Json encoding options
	 *
	 * @return ResponseInterface The response
	 */
	public function withJson(
		ResponseInterface $response,
		$data = null,
		int $options = 0
	): ResponseInterface {
		$response = $response->withHeader('Content-Type', 'application/json');
		$response->getBody()->write((string)json_encode($data, $options));
		
		return $response;
	}
}