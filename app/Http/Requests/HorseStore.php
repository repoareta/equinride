<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorseStore extends FormRequest
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
            'name'            => 'required',
            'owner'           => 'required',
            'birth_date'      => 'required|date_format:Y-m-d|before:today',
            'horse_sex_id'    => 'required',
            'horse_breed_id'  => 'required',
        ];
    }
}
