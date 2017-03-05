<?php


namespace App\Entities;


class HotelServices extends Entity
{

    public function hotel()
    {
        return $this->belongsTo(Hotel::getClass());
    }

    public function services()
    {
        return $this->belongsTo(Services::getClass());
    }
}