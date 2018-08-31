<?php

namespace Application\Helpers\Queue;

class QueueChunk
{
    private $dataChunk;
    private $timeAdded;

    public function __construct(DataChunk $dataChunk, $time)
    {
        $this->dataChunk = $dataChunk;
        $this->timeAdded = $time;
    }

    public function getData(): DataChunk
    {
        return $this->dataChunk;
    }

    public function getTime(): int
    {
        return $this->timeAdded;
    }
}