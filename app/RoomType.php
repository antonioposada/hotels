<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'room_types';

    protected $fillable = ['name', 'num_adults', 'num_children'];


}
