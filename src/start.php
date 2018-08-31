<?php

require(__DIR__ . '/../vendor/autoload.php');

use Application\Bootstrap\Bootstrap;
use Application\Workers\FileProceeder;
use Application\Workers\FileReader;
use Application\Workers\LoopDataProceeder;
use Application\Workers\SocketServer;

class Worker
{
    public function run()
    {
        switch (Bootstrap::getParam('workerType')) {
            case Bootstrap::FILEREADER:
                $proceeder = new FileProceeder();
                $fileReader = new FileReader(
                    Bootstrap::getParam('fileQueue'),
                    $proceeder
                );
                echo $fileReader->start();
                break;
            case Bootstrap::SOCKET_SERVER:
                $proceeder = new LoopDataProceeder();
                $socketServer = new SocketServer(
                    Bootstrap::getParam('socketServerName'),
                    Bootstrap::getParam('socketServerPort'),
                    $proceeder
                    );
                echo $socketServer->start();
                break;
        }
    }
}

(new Worker())->run();