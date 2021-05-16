<?php

namespace App\Domain\Address;

use JsonSerializable;

final class Address extends AddressData implements JsonSerializable
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
	 * @param string $city
	 * @param string $postcode
	 * @param string $streetName
	 * @param string $streetNumber
	 * @param string $countryCode
	 * @param string|null $additionalNotes
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
	
	public function jsonSerialize()
	{
		return get_object_vars($this);
	}
}