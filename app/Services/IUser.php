<?php

/**
 * @author RedHead_DEV = [Kravchenko Dmitriy => dkraf9006@gmail.com]
 */

namespace App\Services;

use App\Http\Requests\Auth\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;

interface IUser
{
    public function store(UserStoreRequest $request);
    public function update(UserUpdateRequest $request, $id);
    public function list();
    public function read($id);
    public function delete($id);
}
