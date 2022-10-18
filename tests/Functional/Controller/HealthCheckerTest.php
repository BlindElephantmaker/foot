<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Helper\Http\Http;
use App\Tests\Infrastructure\FunctionalTest;

final class HealthCheckerTest extends FunctionalTest
{
    public function testThatHealthCheckerHasSuccessResponse(): void
    {
        $client = self::createClient();
        $client->request(Http::METHOD_GET, '/');

        $this->assertResponseIsSuccessful();

        $response = $this->getDecodedResponse($client);
        $this->assertEquals('ok', $response['status']);
    }
}
