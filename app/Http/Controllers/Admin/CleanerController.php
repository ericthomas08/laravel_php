<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cleaner;
use App\City;
use App\CleanerCity;
use Illuminate\Http\Request;
use Session, Redirect, Validator;

class CleanerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cleaners = Cleaner::paginate(25);

        return view('admin.cleaner.index', compact('cleaners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.cleaner.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'quality_score' => 'required',
            'cities' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::route('admin.cleaner.create')
                ->withErrors($validator)
                ->withInput();
        }

        $requestData = $request->all();

        $cleaner = new Cleaner();
        $cleaner->fill($requestData);
        $cleaner->save();

        $cities = $requestData['cities'];

        foreach ($cities as $cityId) {
            $cleanerCity = new CleanerCity();
            $cleanerCity->cleaner_id = $cleaner->id;
            $cleanerCity->city_id = $cityId;
            $cleanerCity->save();
        }

        Session::flash('flash_message', 'Cleaner added!');

        return Redirect::route('admin.cleaner');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $cleaner = Cleaner::findOrFail($id);
        $cities = City::all();

        return view('admin.cleaner.edit', compact('cleaner', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'quality_score' => 'required',
            'cities' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::route('admin.cleaner.edit')
                ->withErrors($validator)
                ->withInput();
        }

        $requestData = $request->all();

        $cleaner = Cleaner::findOrFail($id);
        $cleaner->update($requestData);

        CleanerCity::where('cleaner_id', $id)->delete();
        $cities = $requestData['cities'];

        foreach ($cities as $cityId) {
            $cleanerCity = new CleanerCity();
            $cleanerCity->cleaner_id = $cleaner->id;
            $cleanerCity->city_id = $cityId;
            $cleanerCity->save();
        }

        Session::flash('flash_message', 'Cleaner updated!');

        return Redirect::route('admin.cleaner');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $cleaner = Cleaner::findOrFail($id);

        return view('admin.cleaner.show', compact('cleaner'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        CleanerCity::where('cleaner_id', $id)->delete();
        Cleaner::destroy($id);

        Session::flash('flash_message', 'Cleaner deleted!');

        return Redirect::route('admin.cleaner');
    }
}
