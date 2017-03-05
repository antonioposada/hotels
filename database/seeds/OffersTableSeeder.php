<?php

use Faker\Generator;
use Styde\Seeder\Seeder;

class OffersTableSeeder extends Seeder
{
    protected $total = 5;

    public function getModel()
    {
        return new \App\Offers();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'percentage' => $faker->randomFloat(2,0,100),
            'rate_id' => $this->random('Rates')->id
        ];
    }
}
