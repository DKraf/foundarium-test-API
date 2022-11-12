<?php

namespace Tests\Unit;

use Illuminate\Http\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase {

    /**
     * Тест регистрации
     * @return void
     */
    public function testAuthRegisterSuccess() {

        $payload = [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'phone'      => $this->faker->phoneNumber,
            'password'      => $this->faker->password,
            'email'      => $this->faker->email
        ];
        $this->json('post', 'api/auth/register', $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'status',
                    'message',
                    'data' => [
                        'id'
                    ]
                ]
            );
    }

    /**
     * Тест авторизации
     * @return void
     */
    public function testAuthLoginSuccess()
    {
        $payload = [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'phone'      => $this->faker->phoneNumber,
            'password'   => $this->faker->password,
            'email'      => $this->faker->email
        ];

        $this->json('post', 'api/auth/register', $payload);

        $this->json('post', 'api/auth/login', $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'status',
                    'message',
                    'data' => [
                        "token"
                    ]
                ]
            );
    }

}
