<?php

declare(strict_types=1);

namespace App\Shared\Messenger\Query;

interface QueryBusInterface
{
    public function dispatch(QueryInterface $query): mixed;
}
