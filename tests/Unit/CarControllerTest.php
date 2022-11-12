<?php

namespace Tests\Unit;

use App\Models\Car;
use Illuminate\Http\Response;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    /**
     * Тест создания
     * @return void
     */
    public function testCarStoreSuccess()
    {
        $this->withoutMiddleware()->json('post', 'api/car', $this->getData())
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
     * Тест списка автомобилей
     *
     * @return void
     */
    public function testListCarsReturnsSuccess()
    {
        $car = Car::create($data = $this->getData());

        $this->withoutMiddleware()->json('get', 'api/car')
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'status' => true,
                    "message" => null,
                    "data" => [
                        [
                            'id'    => $car->id,
                            'brand' => $data['brand'],
                            'model' => $data['model'],
                            'color' => $data['color'],
                        ]
                    ]
                ]
            );
    }


    /**
     * Тест информации об автомобиле
     *
     * @return void
     */
    public function testReadCarReturnsSuccess()
    {
        $car = Car::create($data = $this->getData());

        $this->withoutMiddleware()->json('get', 'api/car/'.$car->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'status' => true,
                    "message" => null,
                    "data" => [
                        'id'    => $car->id,
                        'brand' => $data['brand'],
                        'model' => $data['model'],
                        'color' => $data['color'],
                    ]
                ]
            );
    }

    /**
     * Тест редактирования автомобиля
     *
     * @return void
     */
    public function testEditCarSuccess()
    {
        $car = car::create($data = $this->getData());

        $this->withoutMiddleware()->json('post', 'api/car/'.$car->id, ['brand' => 'Honda POWER'])
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'status' => true,
                    "message" => null,
                    "data" => [
                        'id' => (string) $car->id,
                    ]
                ]
            );
    }


    /**
     * Тест удаления автомобиля
     *
     * @return void
     */
    public function testdeleteCarSuccess()
    {
        $car = Car::create($this->getData());

        $this->withoutMiddleware()->json('delete', 'api/car/'.$car->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'status' => true,
                    "message" => null,
                    "data" => [
                        'id' => (string) $car->id,
                    ]
                ]
            );
    }


    /**
     * мокаем фейковые данные автомобиля
     *
     * @return array
     */
    private function getData(): array
    {
        return  [
            'brand' => $this->faker->company,
            'model' => $this->faker->company,
            'color' => $this->faker->colorName,
        ];
    }
}
