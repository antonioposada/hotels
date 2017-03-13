<?php

namespace App\Repositories;

use App\Entities\Services;

class ServiceRepository extends BaseRepository
{

    /**
     * @return Services
     */
    public function getModel()
    {
        return new Services();
    }

    /**
     * @param $hotel_id
     * @return \Illuminate\Support\Collection
     */
    public function getServicesWithoutHotel($hotel_id){

        $this->hotel_id = $hotel_id;
        return $this->newQuery()
            ->select(['services.id','name'])
            ->leftJoin('hotel_services', function ($join) {
                $join->on( 'services.id', '=', 'service_id')
                    ->where('hotel_id', '=', $this->hotel_id);
            })
            ->whereNull('service_id')->get();
    }

}