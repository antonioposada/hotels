<?php

use Styde\Seeder\BaseSeeder;

class DatabaseSeeder extends BaseSeeder
{

    protected $truncate = array(
        'room_types',
        'hotels',
        'rooms',
        'rates',
        'offers',
        'room_rates',
        'services',
        'hotel_services'
    );

    protected $seeders = array(
        'RoomTypes',
        'Hotels',
        'Room',
        'Rates',
        'Offers',
        'RoomRates',
        'Services',
        'HotelServices',
    );
}
