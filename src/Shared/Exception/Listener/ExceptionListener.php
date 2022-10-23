<?php

declare(strict_types=1);

namespace App\Shared\Exception\Listener;

use App\Shared\Exception\DomainException;
use App\Shared\Exception\ValidationException;
use App\Shared\Http\HttpResponseCode;
use App\Shared\Http\JsonResponse;
use App\Shared\Translation\Translation;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Contracts\Translation\TranslatorInterface;
use Throwable;

final class ExceptionListener
{
    public function __construct(
        private TranslatorInterface $translator,
    ) {}

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $this->getExceptionFromEvent($event);
        $httpResponseCode = $this->getHttpResponseCode($exception);

        $message = $this->translator->trans(
            $exception->getMessage(),
            domain: Translation::DOMAIN,
        );

        $event->setResponse(new JsonResponse(
            ['message' => $message],
            $httpResponseCode
        ));
    }

    private function getExceptionFromEvent(ExceptionEvent $event): Throwable
    {
        $exception = $event->getThrowable();

        return $exception instanceof HandlerFailedException ? $exception->getPrevious() : $exception;
    }

    private function getHttpResponseCode(Throwable $exception): int
    {
        if ($exception instanceof ValidationException) {
            return HttpResponseCode::BAD_REQUEST;
        }

        if ($exception instanceof DomainException) {
            return HttpResponseCode::UNPROCESSABLE_ENTITY;
        }

        return HttpResponseCode::INTERNAL_SERVER_ERROR;
    }
}
