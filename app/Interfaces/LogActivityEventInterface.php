<?php

namespace App\Interfaces;

interface LogActivityEventInterface
{
    public function getType(): string;
    public function getStatus(): int;
    public function getData(): array;
    public function getIP(): string;
}