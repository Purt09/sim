<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Operator;
use App\Service\Sim;
use Illuminate\Http\Request;

class SimController extends Controller
{
    public function test($key)
    {
        $sim = new Sim($key);
        $balance = $sim->getBalance();
        dd($balance);
    }

    public function balance()
    {
        $key = env('SIM_KEY');
        $sim = new Sim($key);
        $balance = $sim->getBalance();
        dd($balance);
    }

    public function countries()
    {
        $key = env('SIM_KEY');
        $sim = new Sim($key);
        $countries = $sim->getCountries();

        $countryModel = new Country();
        $countryModel->name = 'any';
        $countryModel->title_ru = 'Любая';
        $countryModel->title_eng = 'any';
        $countryModel->image = env('APP_URL') . '/img/world.png';
        $countryModel->save();

        $operatorModel = new Operator();
        $operatorModel->name = 'any';
        $operatorModel->country_id = $countryModel->id;
        $operatorModel->save();

        foreach ($countries as $key => $country) {
            $countryModel = new Country();
            $countryModel->name = $key;
            $countryModel->title_ru = $country['text_ru'];
            $countryModel->title_eng = $country['text_en'];
            $countryModel->image = 'css://' . 'flags flags-' . array_key_first($country['iso']);
            $countryModel->save();
            unset($country['iso']);
            unset($country['text_ru']);
            unset($country['text_en']);
            unset($country['prefix']);
            $operatorModel = new Operator();
            $operatorModel->name = 'any';
            $operatorModel->country_id = $countryModel->id;
            $operatorModel->save();
            foreach ($country as $key => $operator) {
                if($operator['activation'] == 1) {
                    // $existOperator = Operator::query()->where(['name' => $key])->exists();
                    // if($existOperator)
                    //     continue;
                    $operatorModel = new Operator();
                    $operatorModel->name = $key;
                    $operatorModel->country_id = $countryModel->id;
                    $operatorModel->save();
                }
            }
        }
    }

    public function index()
    {
        dd(2);
    }
}
