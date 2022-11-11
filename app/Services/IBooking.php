<?php

/**
 * @author RedHead_DEV = [Kravchenko Dmitriy => dkraf9006@gmail.com]
 */

namespace App\Services;

use Illuminate\Http\Request;

interface IBooking
{
    public function book($id);
    public function cancel($id);
}
