<?php

namespace Application\Bootstrap;

use Application\Workers\FileWriter;
use Application\Workers\SockerSender;
use MessageBird\Client;

class Bootstrap
{
    const FILEREADER = 0;
    const SOCKET_SERVER = 1;

    public static function getParams()
    {
        return require(__DIR__ . '/../../config.php');
    }

    public static function getParam($name)
    {
        return self::getParams()[$name] ?? false;
    }

    private static $client;

    public static function getClient(): Client
    {
        if (!self::$client) {
            self::$client = new Client(self::getParam('accessKey'));
        }
        return self::$client;
    }

    public static function proceedData($data)
    {
        switch (self::getParam('workerType')) {
            case self::FILEREADER:
                FileWriter::send($data);
                break;
            case self::SOCKET_SERVER:
                SockerSender::send($data);
                break;
        }
    }
}