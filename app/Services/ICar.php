<?php

/**
 * @author RedHead_DEV = [Kravchenko Dmitriy => dkraf9006@gmail.com]
 */

namespace App\Services;

use App\Http\Requests\Car\CarStoreRequest;
use App\Http\Requests\Car\CarUpdateRequest;
use Illuminate\Http\Request;

interface ICar
{
    public function store(CarStoreRequest $request);
    public function update(CarUpdateRequest $request, $id);
    public function list();
    public function read($id);
    public function delete($id);
}
