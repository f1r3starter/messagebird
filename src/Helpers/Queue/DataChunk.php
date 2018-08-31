<?php

namespace Application\Helpers\Queue;

use Application\Helpers\Messages\Message;
use Application\Helpers\Validators\PhoneValidation;

class DataChunk
{
    private $phone;
    private $message;

    public function __construct($data)
    {
        if (!isset($data['message'], $data['phone'])) {
            throw new \InvalidArgumentException('Both phone and message are needed!');
        }
        if (!(new PhoneValidation($data['phone']))->isValid()) {
            throw new \InvalidArgumentException('Phone is incorrect');
        }
        $this->phone = $data['phone'];
        $this->message = new Message($data['message']);
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }
}