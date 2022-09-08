<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans= [   
            [
            'name' => 'Piano 1',
            'price' => '2.99' ,
            'duration' => '24' ,
            ],
            [
                'name' => 'Piano 2',
                'price' => '5.99' ,
                'duration' => '72' ,
            ],
            [
                'name' => 'Piano 3',
                'price' => '9.99' ,
                'duration' => '144' ,
            ],
        ];

        foreach ($plans as $item) {
            $plan = new Plan();
            $plan->name = $item['name'];
            $plan->price = $item['price'];
            $plan->duration = $item['duration'];
            $plan->save();
        }
        
    }
}
