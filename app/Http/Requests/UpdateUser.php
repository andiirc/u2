<?php

namespace U\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:250',
            'username' => 'required|alphanum|max:30',
            'email' => 'required|email|max:50',
            'city' => 'required',
            'admin' => 'boolean',
            'hobby'    => 'required|array|min:1',
            'hobby.*' => 'required|string|distinct|min:1'
        ];
    }
}
