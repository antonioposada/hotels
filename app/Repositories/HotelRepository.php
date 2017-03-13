<?php

namespace App\Repositories;

use App\Entities\Hotel;
use Illuminate\Support\Facades\DB;

class HotelRepository extends BaseRepository {

    public function getModel()
    {
        return new Hotel();
    }

    /**
     * @param $hotel_id
     * @param $service_id
     * @return mixed
     */
    public function deleteService($hotel_id,$service_id){
        return DB::table('hotel_services')
            ->where('hotel_id', '=', $hotel_id)
            ->where('service_id', '=', $service_id)
            ->delete();

    }


}