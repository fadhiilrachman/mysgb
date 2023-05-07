<?php

namespace App\Events\Auth;

use App\Events\Event;
use App\Interfaces\LogActivityEventInterface;

class LoginSucceededEvent extends Event implements LogActivityEventInterface
{
    /** @var array */
    private $data;

    /** @var int */
    private $statusCode;

    /** @var string */
    private $ip;

    public function __construct(array $data, int $statusCode = 200, string $ip = '127.0.0.1')
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->ip = $ip;
    }

    public function getType(): string
    {
        return 'LoginSucceeded';
    }

    public function getIP(): string
    {
        return $this->ip;
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
