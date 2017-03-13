<?php
/**
 * Created by PhpStorm.
 * User: posada
 * Date: 12/03/2017
 * Time: 20:29
 */

namespace App\Repositories;

use App\Entities\Room;
use Illuminate\Support\Facades\DB;

class RoomRepository extends BaseRepository {


    /**
     * @return Room
     */
    public function getModel()
    {
        return new Room();
    }

    /**
     * @param $room_id
     * @param $service_id
     * @return mixed
     */
    public function deleteRate($room_id,$rate_id){
        return DB::table('room_rates')
            ->where('room_id', '=', $room_id)
            ->where('rate_id', '=', $rate_id)
            ->delete();

    }


}