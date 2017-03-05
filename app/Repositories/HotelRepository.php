<?php

namespace App\Repositories;

use App\Hotel;

class HotelRepository extends BaseRepository {

    public function getModel()
    {
        return new Hotel();
    }


}