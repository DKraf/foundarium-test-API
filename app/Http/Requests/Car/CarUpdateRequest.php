<?php

namespace App\Http\Requests\Car;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand'  => 'string',
            'model'   => 'string',
            'colors'  => 'string',
        ];
    }
}
