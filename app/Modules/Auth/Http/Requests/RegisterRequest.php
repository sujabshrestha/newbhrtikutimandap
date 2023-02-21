<?php

namespace Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => ['required','unique:users','numeric','digits:10','regex:/^((984)|(985)|(986)|(974)|(975)|(980)|(981)|(982)|(961)|(962)|(988)|(972)|(963))[0-9]{7}/'],
            'password' => 'required|min:6',
            'passwordconfirmation' => 'required_with:password|same:password|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Name',
            'phone.required' => 'Please Enter Phone No',
            'phone.unique' => 'Phone No Already In Use. Please Use New Phone No.',
            'email.required' => 'Please Enter E-mail',
            'email.email' => 'Please Enter A Valid E-mail',
            'password.required' => 'Please Enter Password',
            'password.min' => 'Password Must Be Greater Than 6 Characters.',
            'passwordconfirmation.same' => 'Confirm Password Must Be Same As Password.',

        ];
    }
}
