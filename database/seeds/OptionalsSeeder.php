<?php

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
        $optional = new Optional();
        $optional->name = 'WiFi';
        $optional->save();
    }
}
