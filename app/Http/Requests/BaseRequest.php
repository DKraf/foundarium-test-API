<?php

/**
 * @author RedHead_Dev => Kravchenko Dmitriy
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     * @return mixed
     */
    public abstract function rules();


    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return mixed
     */
    public function getSanitized()
    {
        return $this->validated();
    }

    public function messages()
    {
        return [
            'required' => 'Не передан обязательный параметр',
            'same'     => 'Новый пароль и подтверждение не совпадают',
            'required_if' => 'Не передан обязательный параметр',
            'string'      => 'Должен быть строкой',
            'integer'     => 'Должен быть числом',
            'json'        => 'Должен быть JSON',
        ];
    }
}
