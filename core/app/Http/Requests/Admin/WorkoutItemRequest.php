<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WorkoutItemRequest extends FormRequest
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
            'workout_name' => 'required |min:5|max:25',
            'photo' => 'image|mimes:jpeg,png,jpg,gif',
            'body_parts_id' => 'required',
            'status' => 'required'
        ];
    }
}
