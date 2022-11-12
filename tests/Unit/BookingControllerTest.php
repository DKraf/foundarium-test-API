<?php

namespace Tests\Unit;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    /**
     * Тест бронирования
     * @return void
     */
    public function testBookingCarSuccess()
    {
        $user = User::create($data = $this->getDataUser());
        $car = Car::create($data = $this->getDataCar());

        $token = $user->createToken($user->email)->plainTextToken;

        $this->withHeaders(['Authorization'=>'Bearer '. $token, 'Accept' => 'application/json'])
            ->json('post', 'api/booking/book/'. $car->id)
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
     * Тест списка бронирований
     *
     * @return void
     */
    public function testListBookingReturnsSuccess()
    {
        $user = User::create($this->getDataUser());
        $car = Car::create($this->getDataCar());

        $token = $user->createToken($user->email)->plainTextToken;

        $this->withHeaders(['Authorization'=>'Bearer '. $token, 'Accept' => 'application/json'])
            ->json('post', 'api/booking/book/'. $car->id);

        $this->withHeaders(['Authorization'=>'Bearer '.$token])->json('get', 'api/booking/active')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'status',
                    'message',
                    'data'
                ]
            );
    }


    /**
     * Тест отмены бронирования
     *
     * @return void
     */
    public function testCancelBookingCarSuccess()
    {
        $user = User::create($this->getDataUser());
        $car = Car::create($this->getDataCar());
        $token = $user->createToken($user->email)->plainTextToken;

        $this->withHeaders(['Authorization'=>'Bearer '. $token, 'Accept' => 'application/json'])
            ->json('post', 'api/booking/book/'. $car->id);

        $this->withHeaders(['Authorization'=>'Bearer '.$token])->json('post', 'api/booking/cancel')
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'status' => true,
                    "message" => null,
                    "data" => [
                        'id' => $car->id,
                    ]
                ]
            );
    }


    /**
     * мокаем фейковые данные автомобиля
     *
     * @return array
     */
    private function getDataCar(): array
    {
        return  [
            'brand' => $this->faker->company,
            'model' => $this->faker->company,
            'color' => $this->faker->colorName,
        ];
    }


    /**
     * мокаем фейковые данные пользователя
     *
     * @return array
     */
    private function getDataUser(): array
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
