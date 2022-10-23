<?php

declare(strict_types=1);

namespace App\Shared\Messenger\Command;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus
    ) {}

    public function dispatch(CommandInterface $command): mixed
    {
        return $this->handle($command);
    }
}
