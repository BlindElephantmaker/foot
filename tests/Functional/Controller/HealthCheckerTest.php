<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Shared\Helper\Http\Http;
use App\Tests\Functional\FunctionalApiTest;

final class HealthCheckerTest extends FunctionalApiTest
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
