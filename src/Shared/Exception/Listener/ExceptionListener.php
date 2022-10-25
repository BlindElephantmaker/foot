<?php

declare(strict_types=1);

namespace App\Shared\Exception\Listener;

use App\Shared\Exception\DomainException;
use App\Shared\Exception\Exception;
use App\Shared\Exception\ValidationException;
use App\Shared\Http\BadRequestResponse;
use App\Shared\Http\InternalServerErrorResponse;
use App\Shared\Http\UnprocessableEntityResponse;
use App\Shared\Translation\TranslationDomain;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Contracts\Translation\TranslatorInterface;
use Throwable;

final class ExceptionListener
{
    public function __construct(
        private readonly TranslatorInterface $translator,
    ) {}

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $this->getDomainException($event->getThrowable());
        if ($exception !== null) {
            $this->setResponseClientError($event, $exception);
            return;
        }

        $this->setResponseInternalError($event);
    }

    private function getDomainException(Throwable $exception): ?Exception
    {
        if ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        return $exception instanceof Exception ? $exception : null;
    }

    private function setResponseClientError(ExceptionEvent $event, Exception $exception): void
    {
        $message = $this->translator->trans(
            $exception::NAME,
            domain: TranslationDomain::match(TranslationDomain::TRANSLATIONS)
        );

        if ($exception instanceof ValidationException) {
            $response = new BadRequestResponse(['message' => $message]);
            $event->setResponse($response);
        }

        if ($exception instanceof DomainException) {
            $response = new UnprocessableEntityResponse(['message' => $message]);
            $event->setResponse($response);
        }
    }

    private function setResponseInternalError(ExceptionEvent $event): void
    {
        $message = $this->translator->trans(
            Exception::NAME,
            domain: TranslationDomain::match(TranslationDomain::TRANSLATIONS),
        );
        $response = new InternalServerErrorResponse(['message' => $message]);
        $event->setResponse($response);
    }
}
