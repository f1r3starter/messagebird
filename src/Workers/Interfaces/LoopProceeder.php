<?php

namespace Application\Workers\Interfaces;

interface LoopProceeder extends DataProceeder
{
    public function stopLoop(): bool;

    public function proceedBackground(): void;
}