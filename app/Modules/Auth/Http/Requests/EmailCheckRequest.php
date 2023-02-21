<?php

namespace Auth\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class EmailCheckRequest extends FormRequest
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
            'email' => 'required|email|exists:users',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please Enter Email Address.',
            'email.email' => 'Please Enter A Valid Email',
            'email.exists' => 'Email Address Does Not Exists In Our System.'
        ];
    }
}
