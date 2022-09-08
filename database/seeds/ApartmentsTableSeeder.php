<?php

use App\Apartment;
use App\Optional;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Faker\Provider\it_IT\Address;
use Faker\Provider\Color;
use Faker\Provider\it_IT\Text;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) { 
            $apartment = new Apartment();
            $apartment->title = $faker->realText($maxNbChars = 20);
            $apartment->user_id = $faker->numberBetween(1, 5);
            $apartment->slug = Apartment::generateApartmentSlugFromTitle($apartment->title);
            $apartment->rooms_number = $faker->numberBetween(1, 10);
            $apartment->beds_number = $faker->numberBetween(1, 10);
            $apartment->bathroom_number = $faker->numberBetween(1, 10);
            $apartment->square_metres = $faker->numberBetween(30, 999);
            $apartment->address = $faker->streetAddress();

            $apiQuery = str_replace(' ', '-', $apartment->address);
            $response = file_get_contents('https://api.tomtom.com/search/2/geocode/' . $apiQuery . '.json?key=Rdcw2GVNiNQGXTWrgewGKq9cwtVYNPRw');
            $response = json_decode($response);

            $apartment->latitude = $response->results[0]->position->lat;
            $apartment->longitude = $response->results[0]->position->lon;

            // $apartment->latitude = $faker->randomFloat(6, -90, 90);
            // $apartment->longitude = $faker->randomFloat(6, -180, 180);
            $apartment->image ="/apartment_images/YOtDMv1XZqIoeTXrVTP86Sohi7ktQpSPVq0TaGYz.jpg";
            $apartment->visible = $faker->numberBetween(0, 1);
            $apartment->save();
            $pippo = [];
            for ($j=0; $j < Optional::count(); $j++) {
                $pippo[]=($faker->numberBetween(1,Optional::count()));
            }
            $apartment->optionals()->sync($pippo);
        }
    }
}
