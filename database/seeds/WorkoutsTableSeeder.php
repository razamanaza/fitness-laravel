<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WorkoutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 150) as $index) {
            $workout = $faker->numberBetween($min = 1, $max = 5);
            $has_distance = App\WorkoutType::find($workout)->has_distance;
            $duration = $faker->numberBetween($min = 1, $max = 180);
            $distance = $has_distance ? $faker->numberBetween($min = 1, $max = 5) * $duration : 0;
            $calories = $faker->numberBetween($min = 1, $max = 3) * $duration * 5;
            DB::table('workouts')->insert([
                'date' => $faker->dateTimeBetween($startDate = '-3 month', $endDate = 'now', $timezone = null),
                'user_id' => $faker->numberBetween($min = 1, $max = 3),
                'workout_type_id' => $workout,
                'distance' => $distance,
                'duration' => $duration,
                'calories' => $calories,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
