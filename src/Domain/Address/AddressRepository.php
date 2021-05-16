<?php

namespace App\Domain\Address;

use App\Factory\QueryFactory;
use App\Middleware\UserPersistance\UserPersistanceMiddleware;
use DI\Container;
use DomainException;

final class AddressRepository
{
	private const TABLE_NAME = "user_address";
	
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
		
		return (int)$this->queryFactory->newInsert(self::TABLE_NAME, $row)
			->execute()->lastInsertId();
	}
	
	/**
	 * @return Address[]
	 */
	public function getUserAddresses(): array
	{
		$query = $this->queryFactory->newSelect(self::TABLE_NAME);
		$query->select(['id', 'user_id', 'city', 'postcode', 'street_name',
			'street_number', 'country_iso', 'additional_notes']);
		$query->andWhere(['user_id' => $this->getCurrentUserId()]);
		
		$rows = $query->execute()->fetchAll('assoc');
		
		return array_map([self::class, 'rowToObject'], $rows);
	}
	
	public function getAddressById(int $addressId): Address
	{
		$query = $this->queryFactory->newSelect(self::TABLE_NAME);
		$query->select(['id', 'user_id', 'city', 'postcode', 'street_name',
			'street_number', 'country_iso', 'additional_notes']);
		
		$query->andWhere([
			'id' => $addressId,
			'user_id' => $this->getCurrentUserId()
		]);
		$row = $query->execute()->fetch('assoc');
		
		if (!$row) {
			throw new DomainException("Address not found");
		}
		
		return self::rowToObject($row);
	}
	
	private static function dataToRow(string $userId, AddressData $data): array
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
	
	private static function rowToObject(array $row): Address
	{
		return new Address($row['id'], $row['user_id'], $row['city'],
			$row['postcode'], $row['street_name'],
			$row['street_number'], $row['country_iso'],
			$row['additional_notes'] ?? null
		);
	}
	
	private function getCurrentUserId(): string
	{
		return $this->container->get
		(UserPersistanceMiddleware::USER_COOKIE_NAME);
	}
}