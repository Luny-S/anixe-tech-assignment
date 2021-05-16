<?php

namespace App\Domain\Address;

use App\Factory\QueryFactory;
use App\Middleware\UserPersistance\UserPersistanceMiddleware;
use DI\Container;

final class AddressRepository
{
	private QueryFactory $queryFactory;
	
	private Container $container;
	
	public function __construct(QueryFactory $queryFactory,
		Container $container)
	{
		$this->queryFactory = $queryFactory;
		$this->container = $container;
	}
	
	public function insertAddress(AddressData $address): int
	{
		$row = self::dataToRow(
			$this->getCurrentUserId(),
			$address
		);
		
		return (int) $this->queryFactory->newInsert('user_address', $row)
			->execute()->lastInsertId();
	}
	
	private static function dataToRow(string $userId, AddressData $data)
	{
		$row = [
			'user_id' => $userId,
			'city' => $data->getCity(),
			'postcode' => $data->getPostcode(),
			'street_name' => $data->getStreetName(),
			'street_number' => $data->getStreetNumber(),
			'country_iso' => $data->getCountryCode(),
		];
		if (!empty($data->getAdditionalNotes())) {
			$row['additional_notes'] = $data->getAdditionalNotes();
		}
		
		return $row;
	}
	
	private function getCurrentUserId(): string
	{
		return $this->container->get
		(UserPersistanceMiddleware::USER_COOKIE_NAME);
	}
}