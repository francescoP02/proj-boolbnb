<?php

use App\Optional;
use Illuminate\Database\Seeder;

class OptionalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $optionals= ['WiFi','Pool','Spa','Sea View','Animals Allowed'];

        foreach ($optionals as $item) {
            $optional = new Optional();
            $optional->name = $item;
            $optional->save();
        }
    }
}
