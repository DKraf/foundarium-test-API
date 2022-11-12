<?php

/**
 * @author RedHead_DEV = [Kravchenko Dmitriy => dkraf9006@gmail.com]
 */

namespace App\Services\Booking;

use App\Models\Car;
use App\Models\CarBooking;
use App\Services\IBooking;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class CarBookingService implements IBooking
{

    /**
     * Бронирование автомобиля
     *
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function book($id): mixed
    {

        if (CarBooking::where('user_id', Auth::user()->id)->first()) {
            throw new \Exception('У вас уже есть забронированный автомобиль', 400);
        }

        if (CarBooking::where('car_id', $id)->first()) {
            throw new \Exception('Авто уже забронированно! Выберите другой', 401);
        }
        try {

            $book = CarBooking::create(['car_id' => $id , 'user_id' => Auth::user()->id]);

            return ['id' => $book->id];

        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }


    /**
     * активное бронирование
     *
     * @return array
     * @throws \Exception
     */
    public function list()
    {
        try {
            if (!$car = CarBooking::where('user_id', Auth::user()->id)->first()) {
                return [];
            }
            return [
                'book' => $car,
                'car' => Car::where('id' , $car->car_id)->first(),
                ];

        } catch (Exception $e) {

            throw new \Exception('Ошибка получения данных', 422);
        }
    }


    /**
     * Удаление брони (СОФТ УДАЛЕНИЕ)
     * @return array
     * @throws \Exception
     */
    public function cancel()
    {
        try {
            if (!$car = CarBooking::where('user_id', Auth::user()->id)->first()) {
                throw new \Exception('У вас нет забронированного автомобиля', 404);
            }

            $car->delete();

            return ['id' => Auth::user()->id];

        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }

}
