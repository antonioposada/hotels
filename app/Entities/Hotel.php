<?php

namespace App\Entities;


class Hotel extends Entity
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category', 'address',
    ];

    public function services()
    {
        return $this->hasMany(HotelServices::getClass());
    }
}
