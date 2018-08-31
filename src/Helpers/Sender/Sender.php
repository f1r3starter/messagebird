<?php

namespace Application\Helpers\Sender;

use Application\Bootstrap\Bootstrap;
use Application\Helpers\Header\UDH;
use Application\Helpers\Messages\Message;
use MessageBird\Objects\Message as SMS;

class Sender
{
    public static function sendMessage($phones, Message $message)
    {
        $messageChunks = array_values($message->getChunkedMessage());
        $chunksLength = $message->getMessagesCount();
        $originator = Bootstrap::getParam('originator');
        $encoding = $message->isUTF() ? SMS::DATACODING_UNICODE : SMS::DATACODING_PLAIN;
        $ref = random_int(0, 255);
        foreach ($messageChunks as $index => $messageChunk) {
            $sms = new SMS();
            $sms->loadFromArray([
                'originator' => $originator,
                'datacoding' => $encoding,
                'recipients' => [$phones],
                'body' => $messageChunk,
                'type' => SMS::TYPE_BINARY,
                'typeDetails' =>
                    [
                        'udh' => (new UDH($chunksLength, $index + 1, $ref))->getHeader()
                    ]
            ]);
            Bootstrap::getClient()->messages->create($sms);
        }
    }
}