<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
      $rules = [
          'agent'                => 'required',
          'customername'         => 'required',
          'customeraddress'      => 'required',
        //   'mobileno'             => 'required|min:5',
        //   'email'                => 'required',


      ];

      return $rules;
    }

    public function messages()
    {
        return [
            'agent.required' => 'Please enter customer name !',
            'customername.required' => 'Please enter customer name !',
            'customeraddress.required' => 'Please enter customer name !',
        ];
    }
}
