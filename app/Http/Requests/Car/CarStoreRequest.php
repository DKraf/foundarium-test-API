<?php

namespace App\Http\Requests\Car;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand'  => 'string|required',
            'model'   => 'string|required',
            'color'  => 'string|required',
        ];
    }
}
