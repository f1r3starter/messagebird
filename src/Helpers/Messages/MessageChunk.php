<?php

namespace Application\Helpers\Messages;

abstract class MessageChunk
{
    abstract protected function getMaxMessage(): int;

    abstract protected function getChunkSize(): int;

    protected function transformChunk(): string
    {
        return implode('', $this->chunk);
    }

    protected function getDoubleSymbols(): array
    {
        return [
            "\u{000A}",
            "\u{005C}",
            "\u{005E}",
            "\u{007E}",
            "\u{005B}",
            "\u{005D}",
            "\u{007B}",
            "\u{007D}",
            "\u{007C}",
            "\u{20AC}"
        ];
    }

    protected $message;
    protected $chunk = [];

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    const SINGLE_SYMBOLS = 1;
    const DOUBLE_SYMBOLS = 2;

    public function getLength()
    {
        $symbolsCount = array_count_values($this->message);
        array_walk($symbolsCount, function (&$count, $symbol) {
            if (\in_array($symbol, $this->getDoubleSymbols(), true)) {
                $count *= self::DOUBLE_SYMBOLS;
            }
        });
        return array_sum($symbolsCount);
    }

    public function chuckMessage()
    {
        if ($this->getLength() > $this->getMaxMessage()) {
            $messages = [];
            $length = 0;
            $message = array_values($this->message);
            array_walk($message, function ($letter, $key) use (&$length, &$messages) {
                if ($length === $this->getChunkSize() || $key === count($this->message)) {
                    $messages[] = $this->transformChunk();
                    $this->chunk = [];
                    $length = 0;
                }
                $length += \in_array($letter, $this->getDoubleSymbols(), true) ? self::DOUBLE_SYMBOLS : self::SINGLE_SYMBOLS;
                $this->chunk[] = $letter;
            }); // this can be done by array_chunk, but with array_chunk it would be impossible to implement double symbols logic
            $this->chunk = [];
            return $messages;
        } else {
            $this->chunk = $this->message;
            $message = $this->transformChunk();
            $this->chunk = [];
            return [$message];
        }
    }
}