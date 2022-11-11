<?php

namespace App\Http\Controllers\API\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\CarStoreRequest;
use App\Http\Requests\Car\CarUpdateRequest;
use App\Http\Resources\CarResource;
use App\Http\Resources\UserResource;
use App\Services\Car\CarService;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseJsonWithHttpStatus;

class CarController extends Controller
{
    use ResponseJsonWithHttpStatus;

    /**
     * Создание автомобиля
     * @param CarService $carService
     * @param CarStoreRequest $request
     * @return JsonResponse
     */
    public function store(CarService $carService, CarStoreRequest $request)
    {
        try {
            return $this->success($carService->store($request), 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Обновление автомобиля
     *
     * @param CarService $carService
     * @param CarUpdateRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(CarService $carService, CarUpdateRequest $request, $id)
    {
        try {
            return $this->success($carService->update($request, $id), 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Список автомобилей
     *
     * @param CarService $carService
     * @return JsonResponse
     */
    public function list(CarService $carService)
    {
        try {

            return response()->json([
                "status"=> true,
                "message"=> null,
                "data" => CarResource::collection($carService->list())
            ] , 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Инфа о автомобиле
     *
     * @param CarService $carService
     * @param $id
     * @return JsonResponse
     */
    public function read(CarService $carService , $id)
    {
        try {
            return response()->json([
                "status"=> true,
                "message"=> null,
                "data" => new CarResource($carService->read($id))
            ] , 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Удаление автомобиля
     *
     * @param CarService $carService
     * @param $id
     * @return JsonResponse
     */
    public function delete(CarService $carService , $id)
    {
        try {

            return $this->success($carService->delete($id), 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

}
