<?php

namespace App\Response;
class JsonResponse implements ResponseInterface
{
    public function __construct(private array $data)
    {
    }

    public function getData()
    {
        return \json_encode($this->data);
    }
}