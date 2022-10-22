<?php

declare(strict_types=1);

namespace App\Shared\Http\EventListener;

use App\Shared\Http\JsonResponse;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

final class ResponseListener
{
    public function __construct()
    {

    }

    public function __invoke(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        if (!$response instanceof JsonResponse) {
            return;
        }
    }
}
