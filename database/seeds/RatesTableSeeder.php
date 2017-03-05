<?php

use Faker\Generator;
use Styde\Seeder\Seeder;

class RatesTableSeeder extends Seeder
{
    protected $total = 20;

    public function getModel()
    {
        return new \App\Rates();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'name'   => $faker->text(50),
            'begin_date' => $faker->date('Y-m-d'),
            'end_date' => $faker->date('Y-m-d','2017-06-30'),
            'price' => $faker->randomFloat(2,1,1000),
            'avalability' => $faker->boolean(80)
        ];
    }
}
