<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class FunctionalTest extends WebTestCase
{
    public function getDecodedResponse(KernelBrowser $client): array
    {
        return json_decode($client->getResponse()->getContent(), true);
    }
}
