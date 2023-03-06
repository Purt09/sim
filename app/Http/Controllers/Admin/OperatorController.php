<?php

namespace App\Http\Controllers\Admin;

use App\Models\Operator;

class OperatorController extends BaseAdminController
{
    public function gets($country)
    {
        $operators = Operator::query()->where(['country_id' => $country])->get();
        return view('admin.operators.gets', compact(['operators', 'country']));
    }
}
