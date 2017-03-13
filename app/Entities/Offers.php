<?php

namespace App\Entities;


class Offers extends Entity
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'percentage',
        'rate_id'
    ];
}
