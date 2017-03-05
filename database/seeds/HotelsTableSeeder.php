<?php

use Faker\Generator;
use Styde\Seeder\Seeder;

class HotelsTableSeeder extends Seeder
{
    protected $total = 5;

    public function getModel()
    {
        return new \App\Hotel();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'name'   => $faker->text(50),
            'category'   => $faker->randomElement([1,2,3,4,5]),
            'address'   => $faker->text(150)
        ];
    }
}
