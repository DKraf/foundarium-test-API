<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseJsonWithHttpStatus;

class UserController extends Controller
{
    use ResponseJsonWithHttpStatus;

    /**
     * Обновление пользователя
     *
     * @param UserService $userService
     * @param UserUpdateRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UserService $userService, UserUpdateRequest $request, $id)
    {
        try {
            return $this->success($userService->update($request, $id), 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Список пользователй
     *
     * @param UserService $userService
     * @return JsonResponse
     */
    public function list(UserService $userService)
    {
        try {

            return response()->json([
                "status"=> true,
                "message"=> null,
                "data" => UserResource::collection($userService->list())
            ] , 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Инфа о пользователи
     *
     * @param UserService $userService
     * @param $id
     * @return JsonResponse
     */
    public function read(UserService $userService , $id)
    {
        try {
            return response()->json([
                "status"=> true,
                "message"=> null,
                "data" => new UserResource($userService->read($id))
            ] , 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Удаление пользователя
     *
     * @param UserService $userService
     * @param $id
     * @return JsonResponse
     */
    public function delete(UserService $userService , $id)
    {
        try {

            return $this->success($userService->delete($id), 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

}
