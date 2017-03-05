<?php

namespace App\Http\Controllers;

use App\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
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
        return RoomType::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'num_adults','num_children']);

        $this->validate($request, [
            'name' => 'required',
            'num_adults' => 'required',
            'num_children'=> 'required'
        ]);

        $roomType = RoomType::create($data);

        return [
            'success' => true,
            'roomtype'    => $roomType->toArray(),
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\RoomType  $roomtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomType $roomtype)
    {
        $this->validate($request, [
            'name' => 'required',
            'num_adults' => 'required',
            'num_children'=> 'required'
        ]);

        $roomtype->fill($request->all());
        $roomtype->save();

        return [
            'success' => true,
            'roomtype'    => $roomtype,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\RoomType  $roomtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomType $roomtype)
    {

        $roomtype->delete();

        return [
            'success' => true,
        ];
    }
}
