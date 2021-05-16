<?php

namespace App\Action\Address;

use App\Action\ActionInterface;
use App\Domain\Address\AddressService;
use App\Responder\Responder;

abstract class AddressAction implements ActionInterface
{
    protected Responder $responder;

    protected AddressService $addressService;

    /**
     * AddressCreateAction constructor.
     * @param Responder $responder
     * @param AddressService $addressService
     */
    public function __construct(
        Responder $responder,
        AddressService $addressService
    )
    {
        $this->responder = $responder;
        $this->addressService = $addressService;
    }
}
