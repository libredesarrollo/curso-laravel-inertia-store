<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class Company extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'identification' => 'required|min:2|max:50',
            'email' => 'required|min:2|max:80',
            'extra' => 'required|min:2|max:255',
            'choices' => 'required',
            'contact_general_id' => 'required',
        ];
    }
}
