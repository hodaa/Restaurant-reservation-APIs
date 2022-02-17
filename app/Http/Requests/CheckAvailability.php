<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckAvailability extends FormRequest
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
            'capacity'=>'required|integer',
            'form_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i,after:form_time'
        ];
    }
}
