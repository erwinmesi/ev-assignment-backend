<?php

namespace App\Rules;

use App\Models\Role;
use Illuminate\Contracts\Validation\Rule;

/**
 * Disable the deletion of the superadmin user.
 */
class DisableSuperadminDeletionRule implements Rule
{
    private $roleIds;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($roleIds)
    {
        $this->roleIds = $roleIds;
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
        // Find the `superadmin` role ID
        $superadminRoleId = Role::where('name', config('roles.default.superadmin.name'))
            ->first()
            ?->id;

        // Allow deletion if the user doesn't have the superadmin role
        return !in_array($superadminRoleId, $this->roleIds);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have no permission to delete this user.';
    }
}
