<?php

namespace App\Http\Requests;

use App\Rules\CheckTableAvailability;
use Illuminate\Foundation\Http\FormRequest;
use ReservationStatus;

class ReservationRequest extends FormRequest
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
            'customer_id' => 'required',
            'capacity' => 'required',
            'from_time' => ['required'],
            'to_time'=> 'required|after:from_time',
        ];
    }

    public function checkout($reservation_id)
    {
       $reservation = Reservation::find($reservation_id)->update(['status'=> ReservationStatus::checkout]);

    }
}
