<?php

namespace App\Domain\Address;

final class Address extends AddressData
{
	/**
	 * @var int
	 */
	protected int $id;
	
	/**
	 * @var string
	 */
	protected string $userId;
	
	/**
	 * Address constructor.
	 * @param int $id
	 * @param string $userId
	 */
	public function __construct(
		int $id,
		string $userId,
		string $city,
		string $postcode,
		string $streetName,
		string $streetNumber,
		string $countryCode,
		?string $additionalNotes = null
	)
	{
		$this->id = $id;
		$this->userId = $userId;
		
		parent::__construct($city,
			$postcode,
			$streetName,
			$streetNumber,
			$countryCode,
			$additionalNotes);
	}
	
	
}