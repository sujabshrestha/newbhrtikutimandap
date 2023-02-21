<?php

namespace User\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordChangeRequest extends FormRequest
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
            'current_password' => 'required|min:6|current_password',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6',
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Please Enter Current Password',
            'current_password.current_password' => 'Please Enter Correct Current Password',
            'current_password.min' => 'Password Must Be Greater Than 6 Characters.',
            'new_password.required' => 'Please Enter Password',
            'new_password.min' => 'Password Must Be Greater Than 6 Characters.',
            'confirm_password.same' => 'Confirm Password Must Be Same As Password.',
        ];
    }
}
