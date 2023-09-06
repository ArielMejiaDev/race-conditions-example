<?php

namespace App\Http\Requests\Meetings;

use App\Rules\UsersAvailable;
use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'meeting_name' => ['required', 'string', 'min:5', 'max:100'],
            'start_time' => ['required', 'unique:meetings,start_time'],
            'user_ids' => ['required', 'array', new UsersAvailable],
        ];
    }
}
