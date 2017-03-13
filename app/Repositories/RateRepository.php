<?php


namespace App\Repositories;

use App\Entities\Rates;

class RateRepository extends BaseRepository
{

    /**
     * @return Rates
     */
    public function getModel()
    {
        return new Rates();
    }

    /**
     * @param $room_id
     * @return \Illuminate\Support\Collection
     */
    public function getRatesWithoutRoom($room_id){

        $this->room_id = $room_id;
        return $this->newQuery()
            ->select(['rates.id','name'])
            ->leftJoin('room_rates', function ($join) {
                $join->on( 'rates.id', '=', 'rate_id')
                    ->where('room_id', '=', $this->room_id);
            })
            ->whereNull('rate_id')->get();
    }

}