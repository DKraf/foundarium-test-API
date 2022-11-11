<?php

/**
 * @author RedHead_DEV = [Kravchenko Dmitriy => dkraf9006@gmail.com]
 */

namespace App\Services\Car;

use App\Http\Requests\Car\CarStoreRequest;
use App\Http\Requests\Car\CarUpdateRequest;
use App\Models\Car;
use App\Services\ICar;
use Mockery\Exception;

class CarService implements ICar
{

    /**
     * Создание новго автомобиля
     *
     * @param CarStoreRequest $request
     * @return array
     * @throws \Exception
     */
    public function store(CarStoreRequest $request): mixed
    {

        $inData = $request->all();

        $car = Car::where('brand', '=',$inData['brand'])
            ->where('model', '=',$inData['model'])
            ->where('color', '=',$inData['color'])
            ->first();
        if ($car) {
            throw new \Exception('Автомобиль создан ранее', 400);
        }

        try {
            $id = Car::create($inData);

            return ['id' => $id->id];

        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }


    /**
     * Список автомобилей
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
    public function list()
    {
        try {

            return Car::all();

        } catch (Exception $e) {

            throw new \Exception('Ошибка получения данных', 422);
        }
    }

    /**
     * информация о автомобиле
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function read($id)
    {
        try {

            if (!$car = Car::find($id)) {
                throw new \Exception('Автомобиль с указаным ID не найден', 404);
            }

            $car->with(['booking']);
            return $car;

        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }


    /**
     * Удаление автомобиля (СОФТ УДАЛЕНИЕ)
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function delete($id)
    {
        try {
            if (!$car = Car::find($id)) {
                throw new \Exception('Автомобиль с указаным ID не найден', 404);
            }

            $car->delete();

            return ['id' => $id];

        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }


    /**
     * Обновление автомобиля
     *
     * @param CarUpdateRequest $request
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function update(CarUpdateRequest $request, $id)
    {
        $inData = $request->all();

        try {

            if (!$car = Car::find($id)) {
                throw new \Exception('Автомобиль с указаным ID не найден', 404);
            }

            $car->update($inData);

            return ['id' => $id];

        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
}
