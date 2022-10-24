<?php

declare(strict_types=1);

namespace App\Shared\Http;

final class UnprocessableEntityResponse extends JsonResponse
{
    public function __construct(mixed $data = null)
    {
        parent::__construct($data, HttpResponseStatus::UNPROCESSABLE_ENTITY);
    }
}
