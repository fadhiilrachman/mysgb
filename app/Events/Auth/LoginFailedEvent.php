<?php

namespace App\Events\Auth;

use App\Events\Event;
use App\Interfaces\LogActivityEventInterface;

class LoginFailedEvent extends Event implements LogActivityEventInterface
{
    /** @var array */
    private $data;

    /** @var string */
    private $message;

    /** @var int */
    private $statusCode;

    public function __construct(array $data, string $message, int $statusCode = 500)
    {
        $this->data = $data;
        $this->message = $message;
        $this->statusCode = $statusCode;
    }

    public function getType(): string
    {
        return 'LoginFailed';
    }

    public function getStatus(): int
    {
        return $this->statusCode;
    }

    public function getData(): array
    {
        return [
            'data' => $this->data,
            'message' => $this->message,
            'status_code' => (int)$this->getStatus()
        ];
    }

}
