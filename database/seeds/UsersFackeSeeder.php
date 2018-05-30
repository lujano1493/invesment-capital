<?php

use Illuminate\Database\Seeder;

class UsersFackeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('users')->truncate();

        foreach (range(1, 300) as $index) {

            $dateCreated=$faker->dateTimeBetween('-5 years' , 'now');
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'last_name' => $faker->lastName,
                'birth_date' =>$faker->dateTimeBetween('-68 years' , ' -18 years'),
                'nickname' =>$faker->userName,
                'status' => 1,
                'role_id' => 0,
                'password' => bcrypt('secret'),
                'keycode' => hash("sha512", random_bytes(5) . 'admin'),
                'created_at' =>$dateCreated,
                'updated_at' =>$dateCreated
            ]);


        }
    }
}
