<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SleepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 3) as $user_id) {
            $now = new DateTime('now');
            $oneday = new DateInterval('P1D');
            $currentDate = new DateTime('now');
            $currentDate->sub(new DateInterval('P2M'));
            while ($currentDate < $now) {
                DB::table('sleeps')->insert([
                    'date' => $currentDate,
                    'user_id' => $user_id,
                    'minutes' => $faker->biasedNumberBetween($min = 300, $max = 600, $function = 'sqrt'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $currentDate->add($oneday);
            }
        }
    }
}
