<?php

namespace App\Http\Controllers;

use App\Services;
use Illuminate\Http\Request;


class ServiceController extends Controller
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
        return Services::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name']);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $service = Services::create($data);

        return [
            'success' => true,
            'service'    => $service->toArray(),
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
        return Services::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Services  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Services $service)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $service->fill($request->all());
        $service->save();

        return [
            'success' => true,
            'service'    => $service,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Services  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Services $service)
    {

        $service->delete();

        return [
            'success' => true,
        ];
    }

}
