<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GymRequest extends FormRequest
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
            'name' => 'required |min:5|max:25',
            'code' => 'required',
            'moto' => 'required',
            'address' => 'required',
            'established' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif',
            'banner' => 'image|mimes:jpeg,png,jpg,gif'
        ];
    }
}
