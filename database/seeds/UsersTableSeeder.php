<?php
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Faker\Provider\en_US\Person;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) { 
            $user = new User();
            $user->name = $faker->firstName();
            $user->surname = $faker->lastName();
            $user->email = $faker->email();
            $user->birth_date = $faker->date();
            $user->password = Hash::make("12345678");
            $user->save();
        }
    }
}
