<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class Person extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'surname' => 'required|min:2|max:80',
            'other' => 'required|min:2|max:255',
            'choices' => 'required',
            'contact_general_id' => 'required',
        ];
    }
}
