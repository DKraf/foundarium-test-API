<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'  => 'string|required',
            'last_name'   => 'string|required',
            'patronymic'  => 'string',
            'password'    => 'string|required',
            'phone'       => ['required', 'unique:users'],
            'email'       => ['required', 'unique:users'],
        ];
    }
}
