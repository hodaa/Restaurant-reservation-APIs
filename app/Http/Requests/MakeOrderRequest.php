<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeOrderRequest extends FormRequest
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
            'reservation_id'=> 'required',
            'customer_id'=> 'required',
            'waiter_id'=> 'required',
            'meals.*'=>'required'
            // 'total'=> 'required',
            // 'paid'=> 'required',
            // 'date'=> 'required',
        ];
    }
}
