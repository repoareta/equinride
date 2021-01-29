<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoachStore extends FormRequest
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
            'name'           => 'required',
            'birth_date'     => 'required|date_format:Y-m-d|before:today',
            'sex'            => 'required',
            'contact_number' => 'required|numeric|digits_between:6,15',
            'experience'     => 'required|numeric|min:1|max:30',
            'certified'      => 'required',
            'stable_id'      => 'required',
        ];
    }
}
