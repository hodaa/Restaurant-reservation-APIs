<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Services\ReservationService;

class CheckTableAvailability implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $table_id;
    private $from_time;
    private $to_time;

    public function __construct($table_id,$from_time,$to_time)
    {
        $this->table_id = $table_id;
        $this->from_time = $from_time;
        $this->to_time = $to_time;
        
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
     
     return app(ReservationService::class)->checkTableAvailable($this->table_id,$this->from_time,$this->to_time);
    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This table is unavailable.';
    }
}
