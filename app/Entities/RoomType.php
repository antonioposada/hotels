<?php

namespace App\Entities;


class RoomType extends Entity
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'room_types';

    protected $fillable = ['name', 'num_adults', 'num_children'];


}
