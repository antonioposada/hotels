<?php


namespace App\Entities;


class HotelServices extends Entity
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hotel_id', 'service_id'
    ];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hotel_services';


    public function hotel()
    {
        return $this->belongsTo(Hotel::getClass());
    }

    public function services()
    {
        return $this->belongsTo(Services::getClass());
    }
}