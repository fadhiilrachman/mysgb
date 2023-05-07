<?php

namespace App\Events\Links;

use App\Events\Event;
use App\Interfaces\LogActivityEventInterface;

class ViewSharingContentFailedEvent extends Event implements LogActivityEventInterface
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
        return 'ViewSharingContentFailed';
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
            'message' => $this->message,
            'status_code' => (int)$this->getStatus()
        ];
    }

}
