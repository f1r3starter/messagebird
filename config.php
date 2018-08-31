<?php

return [
    'accessKey' => '',
    'workerType' => \Application\Bootstrap\Bootstrap::SOCKET_SERVER,
    'fileQueue' => __DIR__ . DIRECTORY_SEPARATOR . 'file.txt',
    'socketServerName' => 'worker',
    'socketServerPort' => 1234,
    'originator' => 'TestSender'
];