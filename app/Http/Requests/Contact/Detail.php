<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class Detail extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'extra' => 'required|min:2|max:500',
            'contact_general_id' => 'required',
        ];
    }
}
