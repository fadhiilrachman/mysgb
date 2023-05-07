<?php

namespace App\Events\Sharing;

use App\Events\Event;
use App\Interfaces\LogActivityEventInterface;

class CreateSharingContentFailedEvent extends Event implements LogActivityEventInterface
{
    /** @var array */
    private $data;

    /** @var string */
    private $message;

    /** @var int */
    private $statusCode;

    /** @var string */
    private $ip;

    public function __construct(array $data, string $message, int $statusCode = 500, string $ip = '127.0.0.1')
    {
        $this->data = $data;
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->ip = $ip;
    }

    public function getType(): string
    {
        return 'CreateSharingContentFailed';
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
            'message' => $this->message,
            'status_code' => (int)$this->getStatus()
        ];
    }

}
