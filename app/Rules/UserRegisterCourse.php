<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Course;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class UserRegisterCourse implements Rule
{
    private $message;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = null;
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
        if (!count($value)) {
            $this->message = 'A minimum of one course is requires';
            return false;
        }
        //validation below is required due to need for DB visit to validate if courses arr valid
        if (count($value) > 10) {
            $this->message = 'You can not register more than ten courses at the same time';
            return false;
        }

        //DB visit to validate if courses selected are valid
        foreach ($value as $course) {
            if (!Course::find($course)) {
                $this->message = "Invalid course with id $course selected";
                return false;
            }
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
        return $this->message;
    }
}
