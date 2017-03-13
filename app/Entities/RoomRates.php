<?php

namespace App\Entities;


class RoomRates extends Entity
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_id', 'rate_id'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'room_rates';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rates()
    {
        return $this->belongsTo(Rates::getClass());
    }
}