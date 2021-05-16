<?php

namespace App\Domain\Address;

class AddressData
{
	/**
	 * @var string
	 */
	protected string $city;
	
	/**
	 * @var string
	 */
	protected string $postcode;
	
	/**
	 * @var string
	 */
	protected string $streetName;
	
	/**
	 * @var int
	 */
	protected int $streetNumber;
	
	/**
	 * @var string
	 */
	protected string $countryCode = 'PL';
	
	/**
	 * @var string|null
	 */
	protected ?string $additionalNotes;
	
	/**
	 * Address constructor.
	 * @param string $city
	 * @param string $postcode
	 * @param string $streetName
	 * @param string $streetNumber
	 * @param string $countryCode
	 * @param string|null $additionalNotes
	 */
	public function __construct(string $city, string $postcode,
		string $streetName, string $streetNumber, string $countryCode,
		?string $additionalNotes = null)
	{
		$this->city = $city;
		$this->postcode = $postcode;
		$this->streetName = $streetName;
		$this->streetNumber = $streetNumber;
		$this->countryCode = $countryCode;
		$this->additionalNotes = $additionalNotes;
	}
	
	/**
	 * @return string
	 */
	public function getCity(): string
	{
		return $this->city;
	}
	
	/**
	 * @return string
	 */
	public function getPostcode(): string
	{
		return $this->postcode;
	}
	
	/**
	 * @return string
	 */
	public function getStreetName(): string
	{
		return $this->streetName;
	}
	
	/**
	 * @return string
	 */
	public function getStreetNumber(): string
	{
		return $this->streetNumber;
	}
	
	/**
	 * @return string
	 */
	public function getCountryCode(): string
	{
		return $this->countryCode;
	}
	
	/**
	 * @return string|null
	 */
	public function getAdditionalNotes(): ?string
	{
		return $this->additionalNotes;
	}
}