<?php

namespace App\Http\Controllers;

use App\Repositories\RateRepository;
use App\Repositories\RoomRepository;
use App\Entities\RoomRates;
use Illuminate\Http\Request;
use App\Entities\Room;
use App\Entities\Hotel;
use App\Entities\RoomType;

class RoomController extends Controller
{

    private $roomRepository;
    private $rateRepository;

    /**
     * RoomController constructor.
     * @param HotelRepository $hotelRepository
     */
    public function __construct(RoomRepository $roomRepository, RateRepository $rateRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->rateRepository = $rateRepository;
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

        $data = $request->only(['name','room_type_id','hotel_id']);

        $this->validate($request, [
            'name' => 'required',
            'room_type_id' => 'required',
            'hotel_id' => 'required'
        ]);

        $room->fill($request->all());
        $room->save();

        return [
            'success' => true,
            'room'    => $room,
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

    /**
     * @param $room_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rates($room_id){
        $room = $this->roomRepository->findOrFail($room_id);
        $rates = $this->rateRepository->getRatesWithoutRoom($room_id);

        return view('config/roomrates',compact('room','rates'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveRate(Request $request){
        $data = $request->only(['rate_id','room_id']);

        $this->validate($request, [
            'room_id' => 'required|numeric',
            'rate_id' => 'required|numeric|min:1'
        ]);

        $roomRates = RoomRates::create($data);

        return $this->rates($data['room_id']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteRate(Request $request){
        $data = $request->only(['rate_id','room_id']);

        $this->validate($request, [
            'room_id' => 'required|numeric',
            'rate_id' => 'required|numeric|min:1'
        ]);

        $this->roomRepository->deleteRate($data['room_id'],$data['rate_id']);

        return $this->rates($data['room_id']);
    }

}
