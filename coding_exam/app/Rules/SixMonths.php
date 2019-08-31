<?php

namespace App\Rules;

use App\Applicant;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class SixMonths implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        // empty return means he can re-apply
        $curr_date =  Carbon::now();
        $filter_date =  Carbon::now()->subMonths(6);
        $where = [
            ['email', '=', $value],
            ['created_at', '>', $filter_date]
        ];

        $applicant = Applicant::where($where)->get();;

        if ($applicant->count()) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute has already applied the job. Please wait another 6 months to re-apply.';
    }
}
