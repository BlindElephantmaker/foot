<?php

declare(strict_types=1);

namespace App\Shared\Messenger\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): mixed;
}
