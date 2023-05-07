<?php

namespace App\Events\Links;

use App\Events\Event;
use App\Interfaces\LogActivityEventInterface;

class ViewSharingContentSucceededEvent extends Event implements LogActivityEventInterface
{
    /** @var array */
    private $data;

    /** @var int */
    private $statusCode;

    public function __construct(array $data, int $statusCode = 200)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    public function getType(): string
    {
        return 'ViewSharingContentSucceeded';
    }

    public function getIP(): string
    {
        return '127.0.0.1';
    }

    public function getStatus(): int
    {
        return $this->statusCode;
    }

    public function getData(): array
    {
        return [
            'data' => $this->data,
            'message' => 'ok',
            'status_code' => (int)$this->getStatus()
        ];
    }

}
