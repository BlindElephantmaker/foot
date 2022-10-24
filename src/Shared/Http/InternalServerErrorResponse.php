<?php

declare(strict_types=1);

namespace App\Shared\Http;

final class InternalServerErrorResponse extends JsonResponse
{
    public function __construct(mixed $data = null)
    {
        parent::__construct($data, HttpResponseStatus::INTERNAL_SERVER_ERROR);
    }
}
