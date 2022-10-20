<?php

declare(strict_types=1);

namespace App\Shared\Action;

use App\Shared\Helper\Http;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api', methods: Http::METHOD_GET)]
final class SecurityHealthCheckerAction
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
