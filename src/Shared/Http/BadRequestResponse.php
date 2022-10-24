<?php

declare(strict_types=1);

namespace App\Shared\Http;

final class BadRequestResponse extends JsonResponse
{
    public function __construct(mixed $data = null)
    {
        parent::__construct($data, HttpResponseStatus::BAD_REQUEST);
    }
}
