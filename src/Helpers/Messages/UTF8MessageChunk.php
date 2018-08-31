<?php

namespace Application\Helpers\Messages;

class UTF8MessageChunk extends MessageChunk {

    protected function getMaxMessage(): int
    {
        return 70;
    }

    protected function getChunkSize(): int
    {
        return 67;
    }
}