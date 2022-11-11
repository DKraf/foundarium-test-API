<?php

/**
 * @author RedHead_DEV = [Kravchenko Dmitriy => dkraf9006@gmail.com]
 */

namespace App\Services;

use Illuminate\Http\Request;

interface IAuth
{
    public function login(Request $request);
    public function logout();
}
