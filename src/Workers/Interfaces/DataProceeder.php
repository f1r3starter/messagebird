<?php

namespace Application\Workers\Interfaces;

interface DataProceeder
{
    public function readData($data): void;

    public function giveResponse(): string;
}