<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 200) as $index) {
            $food = $faker->numberBetween($min = 1, $max = 10);
            $is_alcohol = App\FoodType::find($food)->is_alcohol;
            $drinks = $is_alcohol ? $faker->randomFloat($nbMaxDecimals = 1, $min = 1, $max = 10) : 0;
            $calories = $faker->numberBetween($min = 100, $max = 1000);
            DB::table('foods')->insert([
                'date' => $faker->dateTimeBetween($startDate = '-3 month', $endDate = 'now', $timezone = null),
                'user_id' => $faker->numberBetween($min = 1, $max = 3),
                'food_type_id' => $food,
                'drinks' => $drinks,
                'calories' => $calories,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
