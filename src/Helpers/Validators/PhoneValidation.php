<?php

namespace Application\Helpers\Validators;

class PhoneValidation
{
    private $phone;

    public function __construct($phone)
    {
        $this->phone = preg_replace('/\D/', '', $phone);
    }

    public function isValid(): bool
    {
        return preg_match('/^[1-9]{1}\d{3,14}$/', $this->phone);
    }
}