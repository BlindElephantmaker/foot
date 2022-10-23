<?php

declare(strict_types=1);

namespace App\Shared\Http;

use Symfony\Component\HttpFoundation\Response;

final class HttpResponseCode
{
    public const BAD_REQUEST = Response::HTTP_BAD_REQUEST;
    public const UNPROCESSABLE_ENTITY = Response::HTTP_UNPROCESSABLE_ENTITY;

    public const INTERNAL_SERVER_ERROR = Response::HTTP_INTERNAL_SERVER_ERROR;
}
