<?php

use Styde\Seeder\Seeder;
use Faker\Generator;

class RoomTableSeeder extends Seeder
{
    protected $total = 20;

    public function getModel()
    {
        return new \App\Room();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'name'   => $faker->sentence(),
            'room_type_id' =>  $this->random('RoomType')->id,
            'hotel_id' =>  $this->random('Hotel')->id,
        ];
    }
}
