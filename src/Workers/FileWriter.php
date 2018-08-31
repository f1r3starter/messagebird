<?php

namespace Application\Workers;

use Application\Bootstrap\Bootstrap;
use Application\Workers\Interfaces\Sender;

class FileWriter implements Sender
{
    public static function send(array $data)
    {
        file_put_contents(
            Bootstrap::getParam('fileQueue'),
            json_encode($data) . PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }
}