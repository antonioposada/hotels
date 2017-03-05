<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Hotel;
use App\RoomType;

class RoomController extends Controller
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
            'rooms' => Room::all(),
            'hotels'  => Hotel::all(),
            'roomtypes'  => RoomType::all()
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
        $data = $request->only(['name','room_type_id','hotel_id']);

        $this->validate($request, [
            'name' => 'required',
            'room_type_id' => 'required',
            'hotel_id' => 'required'
        ]);

        $room = Room::create($data);

        return [
            'success' => true,
            'room'    => $room->toArray(),
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
        return Room::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $this->validate($request, [
            'name' => 'required',
            'room_type_id' => 'required',
            'hotel_id' => 'required'
        ]);

        $room->fill($request->all());
        $room->save();

        return [
            'success' => true,
            'offer'    => $room,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return [
            'success' => true,
        ];
    }

}
