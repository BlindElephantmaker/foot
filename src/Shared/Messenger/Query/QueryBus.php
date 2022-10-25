<?php

declare(strict_types=1);

namespace App\Shared\Messenger\Query;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class QueryBus
{
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $messageBus,
    ) {}

    public function dispatch(QueryInterface $query): mixed
    {
        return $this->handle($query);
    }
}
