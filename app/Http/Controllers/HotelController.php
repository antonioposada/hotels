<?php

namespace App\Http\Controllers;

use App\Entities\Hotel;
use App\Entities\HotelServices;
use App\Repositories\HotelRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    private $hotelRepository;
    private $serviceRepository;

    /**
     * HotelController constructor.
     * @param HotelRepository $hotelRepository
     */
    public function __construct(HotelRepository $hotelRepository, ServiceRepository $serviceRepository)
    {
        $this->hotelRepository = $hotelRepository;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hotel::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name','category','address']);

        $this->validate($request, [
            'name' => 'required',
            'category' => 'required|numeric|min:1|max:5'
    /*'start_date' => 'required|date|after:tomorrow'
    'finish_date' => 'required|date|after:start_date'*/
        ]);

        $hotel = Hotel::create($data);

        return [
            'success' => true,
            'hotel'    => $hotel->toArray(),
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
        return Hotel::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $hotel->fill($request->all());
        $hotel->save();

        return [
            'success' => true,
            'hotel'    => $hotel,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {

        $hotel->delete();

        return [
            'success' => true,
        ];
    }

    /**
     * @param $hotel_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function services($hotel_id){

        $hotel = $this->hotelRepository->findOrFail($hotel_id);
        $services = $this->serviceRepository->getServicesWithoutHotel($hotel_id);

        return view('config/hotelservices',compact('hotel','services'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveService(Request $request){
        $data = $request->only(['service_id','hotel_id']);

        $this->validate($request, [
            'hotel_id' => 'required|numeric',
            'service_id' => 'required|numeric|min:1'
        ]);

        $hotel = HotelServices::create($data);

        return $this->services($data['hotel_id']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteService(Request $request){
        $data = $request->only(['service_id','hotel_id']);

        $this->validate($request, [
            'hotel_id' => 'required|numeric',
            'service_id' => 'required|numeric|min:1'
        ]);

        $this->hotelRepository->deleteService($data['hotel_id'],$data['service_id']);

        return $this->services($data['hotel_id']);
    }

}
