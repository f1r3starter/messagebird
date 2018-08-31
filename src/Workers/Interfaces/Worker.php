<?php

namespace Application\Workers\Interfaces;

interface Worker
{
    public function start(): string;
}