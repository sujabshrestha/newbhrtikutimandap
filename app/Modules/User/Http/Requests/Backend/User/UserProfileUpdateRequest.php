<?php

namespace User\Http\Requests\Backend\User;


use Illuminate\Foundation\Http\FormRequest;

class UserProfileUpdateRequest extends FormRequest
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
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Your Full Name.',
            'address.required' => 'Please Enter Your Address.',
            'phone.required' => 'Please Enter Your Phone No.',
            'email.required' => 'Please Enter Your E-Mail.',
            'email.email' => 'Please Enter A Valid E-mail.',
        ];
    }

}
