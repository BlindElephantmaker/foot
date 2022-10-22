<?php

declare(strict_types=1);

namespace App\Shared\Action;

use App\Shared\Http\HttpMethod;
use App\Shared\Http\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', methods: [HttpMethod::GET])]
class HealthCheckerAction
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
