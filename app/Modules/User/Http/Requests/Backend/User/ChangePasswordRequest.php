<?php

namespace User\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        // dd('request');
        return [
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => "Please Enter Password.",
            'password.min' => 'Password Should Have More Than 6 Characters.',
            'password_confirmation.required' => 'Please Enter Confirm Password',
            'password_confirmation.min' => 'Confirm Password Should Have More Than 6 Characters.',
            'password_comfirmation.same' => 'Confirm Password And Password Must Be Same.'
        ];
    }
}
