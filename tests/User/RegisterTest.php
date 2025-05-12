<?php

namespace App\Tests\User;

use App\User\Factory\UserFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Zenstruck\Foundry\Test\Factories;

class RegisterTest extends WebTestCase
{
    use Factories;

    /**
     * @throws \JsonException
     */
    public function testRegisterSuccess(): void
    {
        $client = static::createClient();

        $payload = [
            'email' => 'test@example.com',
            'password' => 'securePassword123',
            'name' => 'Test User',
            'phone' => '+12345678900',
        ];

        $client->request(
            'POST',
            '/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload, JSON_THROW_ON_ERROR)
        );

        self::assertResponseStatusCodeSame(Response::HTTP_CREATED);

        $data = json_decode(
            $client->getResponse()->getContent(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        $this->assertEquals('Вы успешно зарегистрированы', $data['message']);
    }

    /**
     * @throws \JsonException
     */
    public function testRegisterDuplicateUser(): void
    {
        $client = static::createClient();

        UserFactory::createOne([
            'email' => 'test@example.com',
            'phone' => '+12345678900',
        ]);

        $payload = [
            'email' => 'test@example.com',
            'password' => 'securePassword123',
            'name' => 'Test User',
            'phone' => '+12345678900',
        ];

        $client->request(
            'POST',
            '/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload, JSON_THROW_ON_ERROR)
        );

        self::assertResponseStatusCodeSame(409);
        $data = json_decode(
            $client->getResponse()->getContent(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        $this->assertEquals('Пользователь уже зарегистрирован', $data['message']);
    }
}