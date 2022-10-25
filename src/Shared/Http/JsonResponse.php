<?php

declare(strict_types=1);

namespace App\Shared\Http;

abstract class JsonResponse extends \Symfony\Component\HttpFoundation\JsonResponse
{
    public function __construct(
        mixed $data = null,
        HttpResponseStatus $status = HttpResponseStatus::OK,
        array $headers = [],
        bool $json = false
    ) {
        parent::__construct($data, HttpResponseStatus::match($status), $headers, $json);
    }

}
