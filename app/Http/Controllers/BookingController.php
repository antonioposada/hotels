<?php
/**
 * Created by PhpStorm.
 * User: posada
 * Date: 18/02/2017
 * Time: 19:42
 */

namespace App\Http\Controllers;

use App\Repositories\HotelRepository;
use Illuminate\Http\Request;


class BookingController extends Controller
{
    private $hotelRepository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hotel_id)
    {
        $hotel = $this->hotelRepository->findOrFail($hotel_id);
        $hotels = $this->hotelRepository->getModel()->all();
        return view('home/booking', ['hotel'=>$hotel, 'hotels'=> $hotels]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('home/search');
    }

    public function results(Request $request)
    {
        $this->validate($request, [
            'hotel_id' => 'required|numeric|min:1',
            'fecha_entrada' => 'required|date_format:d/m/Y',
            'fecha_salida' => 'required|date_format:d/m/Y',
            'adultos' => 'required|numeric|min:1',
            'ninos'=>'required|numeric'
        ]);

        $hotel_id = $request->get('hotel_id');
        $hotel = $this->hotelRepository->findOrFail($hotel_id);
        $hotels = $this->hotelRepository->getModel()->all();

        return view('home/results', [
            'hotel'=>$hotel,
            'hotels'=> $hotels,
            'adults'=> $request->get('adultos'),
            'children'=> $request->get('ninos'),
            'datestart'=> $request->get('fecha_entrada'),
            'dateend'=> $request->get('fecha_salida')
        ]);
    }
}