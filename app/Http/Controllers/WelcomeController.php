<?php
/**
 * Created by PhpStorm.
 * User: posada
 * Date: 18/02/2017
 * Time: 20:12
 */

namespace App\Http\Controllers;


use App\Repositories\HotelRepository;

class WelcomeController
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
    public function index()
    {
        $hotels = $this->hotelRepository->getModel()->all();
        return view('welcome', compact('hotels'));
    }
}