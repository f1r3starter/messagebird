<?php

namespace Application\Helpers\Header;

class UDH
{
    private $messageLength;
    private $partNumber;
    private $reference;

    const UDH_LENGTH = '05';
    const ELEMENT_ID = '00';
    const HEADER_LENGTH = '03';

    private function formatNumber(int $num): string
    {
        return str_pad(dechex($num), 2, '0', STR_PAD_LEFT);
    }

    public function __construct(int $length, int $partNumber, int $reference)
    {
        $this->messageLength = $this->formatNumber($length);
        $this->partNumber = $this->formatNumber($partNumber);
        $this->reference = $this->formatNumber($reference);
    }

    public function getHeader(): string
    {
        return strtoupper(
            implode(
                '',
                [
                    self::UDH_LENGTH,
                    self::ELEMENT_ID,
                    self::HEADER_LENGTH,
                    $this->reference,
                    $this->messageLength,
                    $this->partNumber
                ]
            )
        );
    }
}