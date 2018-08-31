<?php

namespace Application\Workers\Interfaces;

interface Sender
{
    public static function send(array $data);
}