<?php

use Faker\Generator;
use Styde\Seeder\Seeder;

class ServicesTableSeeder extends Seeder
{

    protected $total = 20;

    public function getModel()
    {
        return new \App\Services();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'name'   => $faker->text(50)
        ];
    }
}
