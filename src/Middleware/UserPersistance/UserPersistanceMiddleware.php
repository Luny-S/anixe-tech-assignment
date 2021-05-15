<?php

namespace App\Middleware\UserPersistance;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

final class UserPersistanceMiddleware
{
	private const USER_COOKIE_NAME = 'user';
	
	/**
	 * @param Request $request
	 * @param RequestHandler $handler
	 */
	public function __invoke(Request $request,
		RequestHandler $handler): ResponseInterface
	{
		/**
		 * Check if user token is present in request
		 */
		$cookies = $request->getCookieParams();
		$userCookie = $cookies[self::USER_COOKIE_NAME] ?? null;
		
		/**
		 * If no user cookie is present then prepare some UID
		 */
		if (empty($userCookie)) {
			$newUserCookieFlag = true;
			$userCookie = openssl_random_pseudo_bytes(8);
			$cookies[self::USER_COOKIE_NAME] = $userCookie;
			$modifiedRequest = $request->withCookieParams($cookies);
		}
		
		$response = $handler->handle($modifiedRequest ?? $request);
		
		if ($newUserCookieFlag ?? false) {
			$modifiedResponse = $response->withHeader("Set-Cookie",
				self::USER_COOKIE_NAME."={$userCookie}");
		}
		
		return $modifiedResponse ?? $response;
	}
}