<?php

declare(strict_types=1);

namespace App\Shared\Action;

use App\Shared\Http\HttpMethod;
use App\Shared\Http\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api', methods: HttpMethod::GET)]
final class SecurityHealthCheckerAction
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
