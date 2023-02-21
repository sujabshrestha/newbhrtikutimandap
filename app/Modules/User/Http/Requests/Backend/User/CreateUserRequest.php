<?php

namespace User\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|confirmed',
            'phone' => 'required|regex:/(98)[0-9]{8}/|min:10|unique:users',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Please Enter User's Name.",
            'email.required' => "Please Enter Email.",
            'email.email' => "Please Enter A Valid E-mail.",
            'email.unique' => "Email Address Already In Use. Please Enter New Email.",
            'password.required' => "Please Enter Password.",
            'password.confirmed' => "Please Enter Correct Password.",
            'phone_no.required' => "Please Enter Phone Number.",
            'phone_no.unique' => "Phone Number Already In Use. Please Enter New Phone Number.",
            'status.required' => "Please Select User Status."
        ];
    }
}
