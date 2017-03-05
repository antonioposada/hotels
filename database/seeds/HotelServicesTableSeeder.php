<?php

use Faker\Generator;
use Styde\Seeder\Seeder;

class HotelServicesTableSeeder extends Seeder
{

    protected $total = 70;

    public function getModel()
    {
        return new \App\HotelServices();
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'hotel_id'   => $this->random('Hotel')->id,
            'service_id' => $this->random('Services')->id,
        ];
    }
}
