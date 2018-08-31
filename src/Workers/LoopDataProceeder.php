<?php

namespace Application\Workers;

use Application\Helpers\Queue\DataChunk;
use Application\Helpers\Queue\Queue;
use Application\Helpers\Queue\QueueChunk;
use Application\Helpers\Sender\Sender;
use Application\Workers\Interfaces\LoopProceeder;

class LoopDataProceeder implements LoopProceeder
{
    protected $queue;
    protected $lastSent;

    public function giveResponse(): string
    {
        return 'Message will be sent';
    }

    public function __construct()
    {
        $this->queue = new Queue();
    }

    public function proceedBackground(): void
    {
        $queueChunk = $this->queue->dequeue();
        if ($queueChunk) {
            if (!$this->lastSent || $queueChunk->getTime() - $this->lastSent >= 1) {
                Sender::sendMessage($queueChunk->getData()->getPhone(), $queueChunk->getData()->getMessage());
                $this->lastSent = time();
            } else {
                $this->queue->enqueue($queueChunk);
            }
        }
    }

    public function readData($data): void
    {
        $dataChunk = new DataChunk($data);
        $this->queue->enqueue(new QueueChunk($dataChunk, time()));
    }

    public function stopLoop(): bool
    {
        return false;
    }
}