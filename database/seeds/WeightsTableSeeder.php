<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WeightsTableSeeder extends Seeder
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
            $baseweight = $faker->numberBetween($min = 50, $max = 100);
            while ($currentDate < $now) {
                DB::table('weights')->insert([
                    'date' => $currentDate,
                    'user_id' => $user_id,
                    'weight' => $faker->numberBetween($min = $baseweight - 5, $max = $baseweight + 5),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                $currentDate->add($oneday);
            }
        }
    }
}
