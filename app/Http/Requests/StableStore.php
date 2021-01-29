<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StableStore extends FormRequest
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
            'name'               => 'required|string|max:255',
            'contact_person'     => 'required|string|max:255',
            'contact_number'     => 'required|numeric|digits_between:6,15',
            'address'            => 'required|string|max:255',
            'province_id'        => 'required',
            'city_id'            => 'required',
            'district_id'        => 'required',
            'village_id'         => 'required',
        ];
    }
}
