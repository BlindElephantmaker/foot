<?php

declare(strict_types=1);

namespace App\Tests\Functional\Shared\Action;

use App\Shared\Http\HttpMethod;
use App\Tests\Functional\FunctionalApiTest;

final class HealthCheckerActionTest extends FunctionalApiTest
{
    public function testThatHealthCheckerHasSuccessResponse(): void
    {
        $client = self::createClient();
        $client->request(HttpMethod::GET, '/');

        $this->assertResponseIsSuccessful();

        $response = $this->getDecodedResponse($client);
        $this->assertEquals('ok', $response['status']);
    }
}
