<?php
/**
 * Created by PhpStorm.
 * User: posada
 * Date: 05/02/2017
 * Time: 11:06
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomRates extends Model
{

    public function room()
    {
        return $this->belongsTo(Room::getClass());
    }

    public function rates()
    {
        return $this->belongsTo(Rates::getClass());
    }
}