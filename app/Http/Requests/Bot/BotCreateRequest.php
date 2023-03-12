<?php

namespace App\Http\Requests\Bot;

use App\Helpers\ApiHelper;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class BotCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'bot_id' => 'required|integer|unique:bots',
            'public_key' => 'required|string|unique:bots',
            'private_key' => 'required|string|unique:bots',
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
