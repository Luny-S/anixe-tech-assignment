<?php

namespace App\Domain\Address;

use Cake\Validation\Validator;
use Selective\Validation\Converter\CakeValidationConverter;
use Selective\Validation\Exception\ValidationException;

final class AddressDataValidator
{
    public function validateAddressData(array $data): void
    {
        $validator = $this->createValidator();

        $result = CakeValidationConverter::createValidationResult(
            $validator->validate($data)
        );

        if ($result->fails()) {
            throw new ValidationException('Invalid data provided', $result);
        }
    }

    private function createValidator(): Validator
    {
        $validator = new Validator();

        return $validator
            ->notEmptyString('city', 'Input required')
            ->maxLength('city', 50, 'Too long')

            ->notEmptyString('postcode', 'Input required')
            ->maxLength('postcode', 10, 'Too long')

            ->notEmptyString('streetName', 'Input required')
            ->maxLength('streetName', 50, 'Too long')

            ->nonNegativeInteger('streetNumber', 'Input required')

            ->notEmptyString('countryCode', 'Input required')
            ->maxLength('countryCode', 2, 'Too long. Two characters ISO country code expected')

            ->maxLength('additionalNotes', 100, 'Too long');
    }
}
