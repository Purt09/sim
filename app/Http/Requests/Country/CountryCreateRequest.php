<?php

namespace App\Http\Requests\Country;

use Illuminate\Foundation\Http\FormRequest;

class CountryCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'title_ru' => 'required',
            'title_eng' => 'required',
        ];
    }
}
