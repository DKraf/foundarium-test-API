<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'  => 'string',
            'last_name'   => 'string',
            'patronymic'  => 'string',
            'phone'       => 'string',
            'email'       => 'string',
        ];
    }
}
