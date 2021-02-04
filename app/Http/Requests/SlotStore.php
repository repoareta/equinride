<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlotStore extends FormRequest
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
            'date' => 'required|before:today',
            'time_start'   => 'required',
            'time_end'   => 'required',
            'capacity'   => 'required',
        ];
    }
}
