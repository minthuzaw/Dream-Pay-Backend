<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('users_management');
        return [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'mobile_phone' => 'required|min:9',
            'nrc' => 'required',
            'levels' => 'required|max:2',
            'balance' => 'required',
            'is_frozen' => 'required',
            'profile_img' => 'required|image',
        ];
    }
}
