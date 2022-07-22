<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserHasEnoughBalanceToTransfer implements Rule
{

    public $userId = '';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
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
        return \App\Models\User::findOrFail($this->userId)->balance >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You do not have enough balance to transfer.';
    }
}
