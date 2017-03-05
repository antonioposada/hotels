<?php

use Styde\Seeder\Seeder;
use Faker\Generator;

class RoomTypesTableSeeder extends Seeder
{
    protected $total = 20;

    public function getModel()
    {
        return new \App\RoomType();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'name'   => $faker->text(50),
            'num_adults' => $faker->numberBetween(1,3),
            'num_children' => $faker->numberBetween(0,3)
        ];
    }
}
