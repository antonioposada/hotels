<?php

namespace App\Entities;


class Room extends Entity
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','room_type_id','hotel_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rates()
    {
        return $this->belongsToMany(Rates::getClass(), 'room_rates','room_id','rate_id')->withTimestamps();
    }

}
