<?php

namespace App\Http\Requests\Bot;

use App\Helpers\ApiHelper;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class BotUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'public_key' => 'required|string',
            'private_key' => 'required|string',
            'version' => 'required|string|min:1|max:1',
            'category_id' => 'required|integer|min:1',
            'percent' => 'required|integer|min:0',
            'api_key' => 'required|string',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function failedValidation(Validator $validator) {
        $response = response()
            ->make(ApiHelper::error($validator->errors()->first()), 422);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

    // protected function failedValidation(Validator $validator): void
    // {
    //     throw new \RuntimeException($validator->errors()->first());
    // }

    // public function failedValidation(Validator $validator)
    // {
    //     throw new \RuntimeException(response()->json([
    //         'success' => false,
    //         'message' => 'Validation errors',
    //         'data' => $validator->errors()
    //     ]));
    // }

    // protected $redirectRoute = 'error';

}
