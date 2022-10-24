<?php

declare(strict_types=1);

namespace App\Shared\Http;

final class SuccessResponse extends JsonResponse
{
    public function __construct(mixed $data = null)
    {
        parent::__construct($data, HttpResponseStatus::OK);
    }
}
