<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Country\CountryCreateRequest;
use App\Http\Requests\Country\CountryUpdateRequest;
use App\Models\Country;
use App\Models\Operator;

class CountryController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = Country::paginate(5);
        return view('admin.countries.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = new Country();
        return view('admin.countries.edit', compact('country'));
    }

    /**
     * @param CountryCreateRequest $request
     */
    public function store(CountryCreateRequest $request)
    {
        $data = $request->input();

        $country = new Country($data);
        $result = $country->save();

        if($result) {
            return redirect()->route('admin.countries.edit', $country->id)
                ->with(['success' => 'Успех']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        if(empty($country)) {
            return back()
                ->withErrors(['msg' => 'Запись не найдена'])
                ->withInput();
        }

        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryUpdateRequest $request, $id)
    {
        $country = Country::find($id);
        if(empty($country)) {
            return back()
                ->withErrors(['msg' => 'Запись не найдена'])
                ->withInput();
        }

        $data = $request->all();
        $result = $country->fill($data)->save();
        //
        if($result) {
            return redirect()->route('admin.countries.edit', $country->id)
                ->with(['success' => 'Успех']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        dd(__METHOD__);
    }

    public function delete()
    {
        $countries = Country::all();

        $operators = Operator::all();
        foreach ($operators as $operator) {
            $operator->delete();
        }
        foreach ($countries as $country) {
            $country->delete();
        }
        return redirect()->route('admin.countries.index')
            ->with(['success' => 'Успех']);
    }
}
