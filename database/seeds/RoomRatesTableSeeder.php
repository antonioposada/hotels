<?php

use Styde\Seeder\Seeder;
use Faker\Generator;

class RoomRatesTableSeeder extends Seeder
{
    protected $total = 40;

    public function getModel()
    {
        return new \App\RoomRates();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'room_id' =>  $this->random('Room')->id,
            'rate_id' =>  $this->random('Rates')->id,
        ];
    }
}
