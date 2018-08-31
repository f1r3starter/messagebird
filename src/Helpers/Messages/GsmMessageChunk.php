<?php

namespace Application\Helpers\Messages;

class GsmMessageChunk extends MessageChunk
{
    protected function getMaxMessage(): int
    {
        return 160;
    }

    protected function getChunkSize(): int
    {
        return 153;
    }
}