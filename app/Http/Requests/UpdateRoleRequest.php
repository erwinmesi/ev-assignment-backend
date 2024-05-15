<?php

namespace App\Http\Requests;

use App\Rules\DisableSuperadminModificationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'name' => [
                new DisableSuperadminModificationRule($this->role->name),
                'required',
                'string',
                'max:255',
                "unique:roles,name,{$this->role->id}" // Exclude self
            ],

            'description' => 'required|string|max:255',
        ];
    }
}
