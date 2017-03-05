<?php

namespace App\Http\Controllers;

use App\Rates;
use Illuminate\Http\Request;

class RatesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rates::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name','begin_date','end_date','price','avalability']);

        $this->validate($request, [
            'name' => 'required',
            'begin_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required',
            'avalability' => 'required',
        ]);

        $rate = Rates::create($data);

        return [
            'success' => true,
            'rate'    => $rate->toArray(),
        ];
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Rates::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Rates  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rates $rate)
    {
        $this->validate($request, [
            'name' => 'required',
            'begin_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required',
            'avalability' => 'required',
        ]);

        $rate->fill($request->all());
        $rate->save();

        return [
            'success' => true,
            'rate'    => $rate,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Rates  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rates $rate)
    {
        $rate->delete();

        return [
            'success' => true,
        ];
    }

}
