<?php

/**
 * @author RedHead_DEV = [Kravchenko Dmitriy => dkraf9006@gmail.com]
 */

namespace App\Services\User;

use App\Http\Requests\Auth\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\IUser;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserService implements IUser
{

    /**
     * Создание новго пользователя
     *
     * @param UserStoreRequest $request
     * @return array
     * @throws \Exception
     */
    public function store(UserStoreRequest $request): mixed
    {
        $inData = $request->all();

        $user = User::where('email', $inData['email'])->first();

        if ($user) {
            throw new \Exception('Пользователь с таким email уже сущевствует', 400);
        }

        $inData['password'] = Hash::make($inData['password']);

        try {
            $id = User::create($inData);

            return ['id' => $id->id];

        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }


    /**
     * Список пользователей
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
    public function list()
    {
        try {

            return User::all();

        } catch (Exception $e) {

            throw new \Exception('Ошибка получения данных', 422);
        }
    }

    /**
     * информация о пользователи
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function read($id)
    {
        try {

            if (!$user = User::find($id)) {
                throw new \Exception('Пользователь с указаным ID не найден', 404);
            }

            $user->with(['booking']);
            return $user;

        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }


    /**
     * Удаление пользователя (СОФТ УДАЛЕНИЕ)
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function delete($id)
    {
        try {
            if (!$user = User::find($id)) {
                throw new \Exception('Пользователь с указаным ID не найден', 404);
            }

            $user->delete();

            return ['id' => $id];

        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }


    /**
     * Обновление пользователя
     *
     * @param UserUpdateRequest $request
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $inData = $request->all();

        try {

            if (!$user = User::find($id)) {
                throw new \Exception('Пользователь с указаным ID не найден', 404);
            }

            $user->update($inData);

            return ['id' => $id];

        } catch (Exception $e) {
            throw new \Exception($e->getMessage(), 500);
        }
    }
}
