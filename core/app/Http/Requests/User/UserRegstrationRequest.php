<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRegstrationRequest extends FormRequest
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
            'fullname'=>'required|max:255',
            'phone'=>'required|max:15',
            'country'=>'required|max:255',
            'email'=>'required|unique:general_users',
            'password'=>'required|max:20|min:5',
            'confirm_password'=>'required|same:password',
        ];
    }
}
