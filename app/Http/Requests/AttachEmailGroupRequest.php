<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachEmailGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email_ids' => 'required|array',
            'group_id' => 'required|exists:email_groups,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array {
        return [
            'email_ids.required' => 'Please select emails to attach',
            'group_id.required' => 'Please select a group to attach emails to',
            'group_id.exists' => 'The selected group does not exist',
        ];
    }
}
