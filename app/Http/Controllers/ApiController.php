<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\Country;
use App\Models\Operator;
use App\Models\User;
use App\Service\Sim;
use Illuminate\Http\Request;

class ApiController
{
    public function countries()
    {
        $countries = Country::all();
        $result = [];
        foreach ($countries as $country) {
            array_push($result, [
                'id' => $country->name,
                'title_ru' => $country->title_ru,
                'title_eng' => $country->title_eng,
                'image' => 'css://flags flags-' . $country->name,
            ]);
        }
        return ApiHelper::success($result);
    }

    public function resources()
    {
        $result[] = [
            'type' => 'css',
            'link' => env('APP_URL') . '/css/app.css'
        ];
        return ApiHelper::success($result);
    }

    public function operators(Request $request)
    {
        $country = Country::query()->where(['name' => $request->country])->first();
        $operators = Operator::query()->where(['country_id' => $country->id])->get();
        $result = [];
        foreach ($operators as $operator) {
            array_push($result, $operator->name);
        }
        return ApiHelper::success($result);
    }

    public function getUser(Request $request)
    {
        if(is_null($request->user_id))
            return ApiHelper::error('user_id params not found');
        $user = User::query()->where(['tg_id' => $request->user_id])->first();
        if(is_null($user)) {
            $user = new User();
            $country = Country::query()->first();
            $operator = Operator::query()->where(['country_id' => $country->id])->first();
            $user->tg_id = $request->user_id;
            $user->country_id = $country->id;
            $user->operator_id = $operator->id;
            $user->language = User::LANGUAGE_RU;
            $user->save();
        } else {
            $country = Country::query()->where(['id' => $user->country_id])->first();
            $operator = Operator::query()->where(['id' => $user->operator_id])->first();
        }
        return ApiHelper::success($this->generateUserArray($user, $country, $operator));
    }

    public function setCountry(Request $request)
    {
        if(is_null($request->user_id))
            return ApiHelper::error('user_id params not found');
        if(is_null($request->operator))
            return ApiHelper::error('operator params not found');
        $user = User::query()->where(['tg_id' => $request->user_id])->first();
        if(is_null($user))
            return ApiHelper::error('user not found');
        $country = Country::query()->where(['name' => $request->country])->first();
        if(is_null($country))
            return ApiHelper::error('country not found');
        $operator = Operator::query()->where(['id' => $user->operator_id])->first();
        $user->country_id = $country->id;
        $user->operator_id = $operator->id;
        $user->save();
        return ApiHelper::success($this->generateUserArray($user, $country, $operator));
    }

    public function setOperator(Request $request)
    {
        if(is_null($request->user_id))
            return ApiHelper::error('user_id params not found');
        if(is_null($request->operator))
            return ApiHelper::error('operator params not found');
        $user = User::query()->where(['tg_id' => $request->user_id])->first();
        if(is_null($user))
            return ApiHelper::error('user not found');
        $country = Country::query()->where(['id' => $user->country_id])->first();
        $operator = Operator::query()->where([
            'name' => $request->operator,
            'country_id' => $country->id
        ])->first();
        if(is_null($operator))
            return ApiHelper::error('operator not found');
        $user->country_id = $country->id;
        $user->operator_id = $operator->id;
        $user->save();
        return ApiHelper::success($this->generateUserArray($user, $country, $operator));
    }

    public function setLanguage(Request $request)
    {
        if(is_null($request->user_id))
            return ApiHelper::error('user_id params not found');
        if(is_null($request->language))
            return ApiHelper::error('language params not found');
        $user = User::query()->where(['tg_id' => $request->user_id])->first();
        if(is_null($user))
            return ApiHelper::error('user not found');
        if($request->language != 'ru' && $request->language != 'eng')
            return ApiHelper::error('language not found');
        $user->language = $request->language;
        $user->save();
        $country = Country::query()->where(['id' => $user->country_id])->first();
        $operator = Operator::query()->where(['id' => $user->operator_id])->first();
        return ApiHelper::success($this->generateUserArray($user, $country, $operator));
    }

    private function generateUserArray(User $user, Country $country, Operator $operator): array
    {
        $result = [
            'id' => $user->tg_id,
            'country' => $country->name,
            'operator' => $operator->name,
            'language' => $user->language
        ];
        return $result;
    }

    public function services(Request $request)
    {
        if(is_null($request->user_id))
            return ApiHelper::error('user_id params not found');
        $user = User::query()->where(['tg_id' => $request->user_id])->first();
        if(is_null($user))
            return ApiHelper::error('user not found');
        $user->language = $request->language;

        $country = Country::query()->where(['id' => $user->country_id])->first();
        $operator = Operator::query()->where(['id' => $user->operator_id])->first();

        $key = env('SIM_KEY');
        $sim = new Sim($key);
        $products = $sim->getProducts($country->name, $operator->name);
        $result = [];
        foreach ($products as $key => $product) {
            array_push($result, [
                'name' => $key,
                'image' => 'css://products products-' . $key,
                'count' => $product['Qty'],
                'cost' => $product['Price']
            ]);
        }
        return ApiHelper::success($result);
    }
}
