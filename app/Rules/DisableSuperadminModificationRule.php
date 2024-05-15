<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Disable the editing or deleting of the superadmin role.
 */
class DisableSuperadminModificationRule implements Rule
{
    private $roleToEdit;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($roleToEdit)
    {
        $this->roleToEdit = $roleToEdit;
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
        return $this->roleToEdit !== config('roles.default.superadmin.name');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You are not allowed to modify this role.';
    }
}
