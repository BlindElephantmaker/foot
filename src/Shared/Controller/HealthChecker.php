<?php

declare(strict_types=1);

namespace App\Shared\Controller;

use App\Shared\Helper\Http\Http;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', methods: [Http::METHOD_GET])]
class HealthChecker
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
