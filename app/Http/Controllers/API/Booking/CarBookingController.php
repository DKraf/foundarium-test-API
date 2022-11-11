<?php

namespace App\Http\Controllers\API\Booking;

use App\Http\Controllers\Controller;
use App\Services\Booking\CarBookingService;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseJsonWithHttpStatus;

class CarBookingController extends Controller
{
    use ResponseJsonWithHttpStatus;

    /**
     * забронировать автомобиль
     *
     * @param CarBookingService $carBookingService
     * @param $id
     * @return JsonResponse
     */
    public function book(CarBookingService $carBookingService, $id)
    {
        try {
            return $this->success($carBookingService->book($id), 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * отменить бронь
     *
     * @param CarBookingService $carBookingService
     * @return JsonResponse
     */
    public function cancel(CarBookingService $carBookingService)
    {
        try {
            return $this->success($carBookingService->cancel(), 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * активное бронирование
     *
     * @param CarBookingService $carBookingService
     * @return JsonResponse
     */
    public function active(CarBookingService $carBookingService)
    {
        try {
            return $this->success($carBookingService->list(), 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
