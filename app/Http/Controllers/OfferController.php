<?php

namespace App\Http\Controllers;

use App\Offers;
use Illuminate\Http\Request;
use App\Rates;

class OfferController extends Controller
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
        return [
            'offers' => Offers::all(),
            'rates'  => Rates::all()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['percentage','rate_id']);

        $this->validate($request, [
            'percentage' => 'required',
            'rate_id' => 'required'
        ]);

        $offer = Offers::create($data);

        return [
            'success' => true,
            'offer'    => $offer->toArray(),
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
        return Offers::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Offers  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offers $offer)
    {
        $this->validate($request, [
            'percentage' => 'required',
            'rate_id' => 'required'
        ]);

        $offer->fill($request->all());
        $offer->save();

        return [
            'success' => true,
            'offer'    => $offer,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Offers  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offers $offer)
    {
        $offer->delete();

        return [
            'success' => true,
        ];
    }

}
