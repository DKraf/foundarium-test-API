<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserStoreRequest;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseJsonWithHttpStatus;

class AuthController extends Controller
{
    use ResponseJsonWithHttpStatus;

    public function register(UserService $userService, UserStoreRequest $request)
    {
        try {
            return $this->success($userService->store($request), 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
    /**
     * Login method
     *
     * @param Request $request
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function login(Request $request, AuthService $authService): JsonResponse
    {
        try {
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required'
            ]);

            return $this->success($authService->login($request));
        } catch (\Exception $e) {
            return $this->error($e->getMessage() , 400);
        }
    }


    /**
     * Logout method
     *
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function logout (AuthService $authService): JsonResponse
    {
        try {
            return $this->success($authService->logout());
        } catch (\Exception $e) {
            return $this->error($e->getMessage() , $e->getCode());
        }
    }
}
