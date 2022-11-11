<?php

/**
 * @author RedHead_DEV = [Kravchenko Dmitriy => dkraf9006@gmail.com]
 */

namespace App\Services\Auth;

use App\Models\User;
use App\Services\IAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements IAuth
{

    /**
     * Метод авторизации
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function login(Request $request): mixed
    {
        if (!$user = User::where('email', $request->input('email'))->first()) {
            throw new \Exception('Пользователь не найден', 404);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            throw new \Exception('Пароль указан не верно', 401);
        }
        try {

            return ['token' => $user->createToken($user->email)->plainTextToken];

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }


    /**
     * Метод Логаут
     *
     * @return array
     * @throws \Exception
     */
    public function logout()
    {
        if (!$user = Auth::user()) {
            throw new \Exception('Unauthorized', 401);
        }

        $user->tokens()->delete();

        return [
            'user_id' => $user->id
        ];
    }

}
