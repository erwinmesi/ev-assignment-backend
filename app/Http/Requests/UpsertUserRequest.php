<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertUserRequest extends FormRequest
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
        $userId = $this->user?->id;

        /**
         * If we are updating a user,
         * we need to make sure the email is unique except for the user being updated.
         */
        $uniqueEmailRule = $userId
            ? "unique:users,email,{$userId}"
            : 'unique:users,email';

        return [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => ['required', 'max:255', 'email', $uniqueEmailRule],
            'role_ids' => 'required|array',

            // Make sure all items of role_ids exist in the roles table
            'role_ids.*' => ['required', 'integer', 'exists:roles,id']
        ];
    }
}
