<?php

declare(strict_types=1);

namespace App\Shared\Http;


final class JsonResponse extends \Symfony\Component\HttpFoundation\JsonResponse
{
    public function __construct(mixed $data = null, int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($data, $status, $headers, $json);
    }
}
