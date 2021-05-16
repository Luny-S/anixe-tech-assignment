<?php

namespace App\Middleware\UserPersistance;

use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

final class UserPersistanceMiddleware
{
	public const USER_COOKIE_NAME = 'user';
	
	private Container $container;
	
	public function __construct(Container $container)
	{
		$this->container = $container;
	}
	
	/**
	 * @param Request $request
	 * @param RequestHandler $handler
	 */
	public function __invoke(Request $request,
		RequestHandler $handler): ResponseInterface
	{
		/**
		 * Check if a user token is present in the incoming request
		 */
		$cookies = $request->getCookieParams();
		$userCookie = $cookies[self::USER_COOKIE_NAME] ?? null;
		
		/**
		 * If no user token is present then prepare UID which will mimic the
		 * unique user logging in
		 *
		 * The user token is a string of 8 pseudo-random bytes (converted to
		 * string with hex values) as a pseudo-authorization mechanism.
		 *
		 * As for a real mechanism I would use Authorization header
		 * with token (e.g. Json Web Token using firebase/php-jwt lib)
		 */
		if (empty($userCookie)) {
			$newUserCookieFlag = true;
			$userCookie = bin2hex(openssl_random_pseudo_bytes(8));
			$cookies[self::USER_COOKIE_NAME] = $userCookie;
			$modifiedRequest = $request->withCookieParams($cookies);
		}
		
		$this->container->set(
			UserPersistanceMiddleware::USER_COOKIE_NAME,
			$userCookie
		);
		$response = $handler->handle($modifiedRequest ?? $request);
		
		if ($newUserCookieFlag ?? false) {
			$modifiedResponse = $response->withHeader("Set-Cookie",
				self::USER_COOKIE_NAME."={$userCookie}");
		}
		
		return $modifiedResponse ?? $response;
	}
}