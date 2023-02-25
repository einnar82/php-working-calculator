<?php

namespace App\Manager;

use App\Response\JsonResponse;
use App\Response\Response;

class ResponseManager
{
    private const JSON_FORMAT = 'json';

    public function __construct(private array $data, private string $format = self::JSON_FORMAT)
    {
    }

    /**
     * @return array|false|string
     */
    public function __invoke()
    {
        return match ($this->format) {
            self::JSON_FORMAT => (new JsonResponse($this->data))->getData(),
            default => (new Response($this->data))->getData()
        };
    }
}