<?php

namespace Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password' => 'required|min:6',
            'passwordconfirmation' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Please Enter Password.',
            'passwordconfirmation.required' => 'Enter To Confirm Password.',
            'passwordconfirmation.same' => 'Password and Confirm Password Must Be Same.',
        ];
    }
}
