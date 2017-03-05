<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','begin_date','end_date','price','avalability'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
        return $this->hasMany(Offers::class);
    }
}
