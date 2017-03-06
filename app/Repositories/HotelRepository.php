<?php

namespace App\Repositories;

use App\Entities\Hotel;

class HotelRepository extends BaseRepository {

    public function getModel()
    {
        return new Hotel();
    }


}