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

    /**
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
    public function services()
    {
        return $this->belongsToMany(Services::getClass(), 'hotel_services','hotel_id','service_id')->withTimestamps();
    }
}
