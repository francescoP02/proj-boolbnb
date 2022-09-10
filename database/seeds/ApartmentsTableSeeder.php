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
        $prefix = ['Villa', 'Casa', 'Condominio', 'Appartemento'];
        $nameImg = ['eBDNg71fji13uyBF0obhOI1pVyCscD5pqiayi3Tk', 'hiG1ALXj5Vti5cRAq1r4pbIxN82vMPnU8RpugyGH', 'hKnZQ7BRq6DC0LQH5fzS5Q8x6o7iWkPYtlQAonr3', 'JauHf8W4ownxC9KWat6JiXSBqfnSi0EUCx4Mtg3y', 'KLH2WOZ3ytAcOG0ZBoIeR7oPfCwC8i9jxgBJAaFY', 'KLH2WOZ3ytAcOG0ZBoIeR7oPfCwC8i9jxgBJAaFY', 'oeLjaayaLeJbM7pWE97ejV1KZfZLoaw2uAtwJzzZ', 'qQVPpGZmyI7xXhDXcngByEXM5B3SoIfCx7R9d48C', 'uyRUr4F5YrthSFLmW7J2yD7zL3cCeNZl4MgXkYip', 'yndds22EbSeFZ91Ud3XmGQhALQKhzoBJs4sJUWz8'];
        // $suffix = ['Leonarda', 'Dei Fiori', 'Celeste', 'Perla marina', 'Del Sentiero Segreto', 'Del Sole', 'Blu', 'San Vincenzo', 'Batllo', 'Ghaudi'];

        // $apt_names = [];

        // for ($i = 0; $i < count($suffix); $i++){
        //     for ($j = 0; $j<count($prefix);$j++){
        //         $name = $suffix[$i] . " " .  $prefix[$j];
        //         if ()
        //     }
        // }

        for ($i = 0; $i < 20; $i++) {
            $apartment = new Apartment();
            // $apartment->title = $faker->realText($maxNbChars = 20);
            $apartment->title = $prefix[rand(0, count($prefix) - 1)] . ' ' . $faker->realText($maxNbChars = 10);
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

            if ($response->results) {
                $apartment->latitude = $response->results[0]->position->lat;
                $apartment->longitude = $response->results[0]->position->lon;
            }

            // $apartment->latitude = $faker->randomFloat(6, -90, 90);
            // $apartment->longitude = $faker->randomFloat(6, -180, 180);
            $apartment->image = 'apartment_images/' . $nameImg[rand(0, count($nameImg) - 1)] . '.jpg';
            $apartment->visible = $faker->numberBetween(0, 1);
            if ($response->results) {
                $apartment->save();
            }
            $pippo = [];
            for ($j = 0; $j < Optional::count(); $j++) {
                $pippo[] = ($faker->numberBetween(1, Optional::count()));
            }
            $apartment->optionals()->sync($pippo);
        }
    }
}
