<?php

namespace Application\Workers;

use Application\Helpers\Queue\DataChunk;
use Application\Helpers\Queue\QueueChunk;

class FileProceeder extends LoopDataProceeder
{
    public function readData($data): void
    {
        if (!isset($data['time'])) {
            throw new \InvalidArgumentException('Time must be specified');
        }
        $dataChunk = new DataChunk($data);
        $this->queue->enqueue(new QueueChunk($dataChunk, $data['time']));
    }
}