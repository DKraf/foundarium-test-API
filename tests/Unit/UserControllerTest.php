<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{

    /**
     * Тест на не авторизованного пользователя
     *
     * @return void
     */
    public function testReturnsUnauthenticated()
    {
        $this->json('get', 'api/user')
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertExactJson(
                [
                    'status' => false,
                    "message" => "Unauthenticated.",
                    "data" => []
                ]
            );
    }


    /**
     * Тест списка пользователей
     *
     * @return void
     */
    public function testListUsersReturnsSuccess()
    {
        $user = User::create($data = $this->getData());

        $this->withoutMiddleware();
        $this->json('get', 'api/user')
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'status' => true,
                    "message" => null,
                    "data" => [
                        [
                            'id'         => $user->id,
                            'first_name' => $data['first_name'],
                            'last_name'  => $data['last_name'],
                            'phone'      => $data['phone'],
                            'email'      => $data['email']
                        ]
                    ]
                ]
            );
    }


    /**
     * Тест информации о пользователи
     *
     * @return void
     */
    public function testReadUserReturnsSuccess()
    {
        $user = User::create($data = $this->getData());

        $this->withoutMiddleware()->json('get', 'api/user/'.$user->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'status' => true,
                    "message" => null,
                    "data" => [
                        'id'         => $user->id,
                        'first_name' => $data['first_name'],
                        'last_name'  => $data['last_name'],
                        'phone'      => $data['phone'],
                        'email'      => $data['email']
                    ]
                ]
            );
    }

    /**
     * Тест редактирования пользователя
     *
     * @return void
     */
    public function testEditUserSuccess()
    {
        $user = User::create($data = $this->getData());

        $this->withoutMiddleware()->json('post', 'api/user/'.$user->id, ['first_name' => $this->faker->firstName])
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'status' => true,
                    "message" => null,
                    "data" => [
                        'id' => (string) $user->id,
                    ]
                ]
            );
    }


    /**
     * Тест удаления пользователя
     *
     * @return void
     */
    public function testdeleteUserSuccess()
    {
        $user = User::create($this->getData());

        $this->withoutMiddleware()->json('delete', 'api/user/'.$user->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'status' => true,
                    "message" => null,
                    "data" => [
                        'id' => (string) $user->id,
                    ]
                ]
            );
    }


    /**
     * мокаем фейковые данные польщователя
     *
     * @return array
     */
    private function getData(): array
    {
        return  [
            'first_name' => $this->faker->firstName,
            'last_name'  => $this->faker->lastName,
            'phone'      => $this->faker->phoneNumber,
            'password'   => $this->faker->password,
            'email'      => $this->faker->email
        ];
    }
}
