<?php

namespace App\Http\Requests;

use App\Rules\DisableSuperadminDeletionRule;
use Illuminate\Foundation\Http\FormRequest;

class DeleteUserRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'role_ids' => $this->user->roles->pluck('id')->toArray()
        ]);
    }

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
            'role_ids' => new DisableSuperadminDeletionRule($this->role_ids)
        ];
    }
}
