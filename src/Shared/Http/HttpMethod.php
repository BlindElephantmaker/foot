<?php

declare(strict_types=1);

namespace App\Shared\Http;

use Symfony\Component\HttpFoundation\Request;

final class HttpMethod
{
    public const GET = Request::METHOD_GET;
    public const POST = Request::METHOD_POST;
}
