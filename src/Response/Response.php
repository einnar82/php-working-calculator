<?php

namespace App\Response;

class Response implements ResponseInterface
{
    public function __construct(private array $data)
    {
    }

    public function getData()
    {
       return $this->data;
    }
}