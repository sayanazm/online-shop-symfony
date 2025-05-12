<?php

namespace App\Tests\User;

use App\User\Factory\UserFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Zenstruck\Foundry\Test\Factories;

class LoginTest extends WebTestCase
{
    use Factories;

    /**
     * @throws \JsonException
     */
    public function testLoginSuccess(): void
    {
        $client = static::createClient();

        $u = UserFactory::createOne([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $client->request('POST', '/api/login', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'email' => $u->getEmail(),
            'password' => 'password',
        ], JSON_THROW_ON_ERROR));

        self::assertResponseIsSuccessful();

        $data = json_decode(
            $client->getResponse()->getContent(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $this->assertArrayHasKey('token', $data);
    }

    /**
     * @throws \JsonException
     */
    public function testLoginInvalidCredentials(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/login', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'username' => 'testuser@example.com',
            'password' => 'wrongPass',
        ], JSON_THROW_ON_ERROR));

        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST);
    }

}