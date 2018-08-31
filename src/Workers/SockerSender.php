<?php

namespace Application\Workers;

use Application\Bootstrap\Bootstrap;
use Application\Workers\Interfaces\Sender;

class SockerSender implements Sender
{
    public static function send(array $data)
    {
        $sock = socket_create(AF_INET,SOCK_STREAM,0) or die("Cannot create a socket");
        socket_connect($sock, Bootstrap::getParam('socketServerName'), Bootstrap::getParam('socketServerPort')) or die("Could not connect to the socket");
        socket_write($sock, json_encode($data));
        socket_close($sock);
    }
}