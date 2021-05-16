<?php

namespace App\Domain\Address;

final class AddressService
{
	private AddressRepository $repository;
	
	private AddressDataValidator $dataValidator;
	
	/**
	 * AddressService constructor.
	 * @param AddressRepository $repository
	 * @param AddressDataValidator $dataValidator
	 */
	public function __construct(
		AddressRepository $repository,
		AddressDataValidator $dataValidator
	)
	{
		$this->repository = $repository;
		$this->dataValidator = $dataValidator;
	}
	
	public function createAddress(array $data): int
	{
		/**
		 * Data validator should be put here
		 */
		$this->dataValidator->validateAddressData($data);
		
		$addressData = new AddressData(
			$data['city'],
			$data['postcode'],
			$data['streetName'],
			$data['streetNumber'],
			$data['countryCode'],
			$data['additionalNotes'] ?? null
		);
		
		return $this->repository->insertAddress($addressData);
	}
	
	public function getAddress(int $addressId): Address
	{
		return $this->repository->getAddressById($addressId);
	}
	
	/**
	 * @return Address[]
	 */
	public function getAddresses(): array
	{
		return $this->repository->getUserAddresses();
	}
	
	public function deleteAddress(int $addressId): void
	{
		$this->repository->deleteAddressById($addressId);
	}
}