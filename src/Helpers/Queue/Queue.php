<?php

namespace Application\Helpers\Queue;

class Queue
{
    private $queue = [];

    public function enqueue(QueueChunk $chunk)
    {
        $this->queue[] = $chunk;
    }

    public function dequeue(): ?QueueChunk
    {
        return array_shift($this->queue);
    }
}