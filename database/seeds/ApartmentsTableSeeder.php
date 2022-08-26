<?php

use App\Apartment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) { 
            $apartment = new Apartment();
            $apartment->title = $faker->sentence();
            $apartment->slug = Str::slug($apartment->title, '-');
            $apartment->rooms_number = $faker->numberBetween(0, 10);
            $apartment->beds_number = $faker->numberBetween(0, 10);
            $apartment->bathroom_number = $faker->numberBetween(0, 10);
            $apartment->square_metres = $faker->numberBetween(0, 9999);
            $apartment->address = $faker->sentence();
            $apartment->latitude = $faker->randomFloat(6, 1, 999);
            $apartment->longitude = $faker->randomFloat(6, 1, 999);
            $apartment->images = $faker->paragraph(rand(10, 30));
            $apartment->visible = $faker->numberBetween(0, 1);
            $apartment->save();
        }
    }
}
