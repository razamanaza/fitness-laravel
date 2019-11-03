<?php

use Illuminate\Database\Seeder;

class FoodTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food_types')->insert([
            'name' => 'Wine',
            'is_alcohol' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('food_types')->insert([
            'name' => 'Beer',
            'is_alcohol' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('food_types')->insert([
            'name' => 'Cake',
            'is_alcohol' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('food_types')->insert([
            'name' => 'Hamburger',
            'is_alcohol' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('food_types')->insert([
            'name' => 'Donuts',
            'is_alcohol' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('food_types')->insert([
            'name' => 'Pizza',
            'is_alcohol' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('food_types')->insert([
            'name' => 'Fish&Chips',
            'is_alcohol' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('food_types')->insert([
            'name' => 'Hot Dog',
            'is_alcohol' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('food_types')->insert([
            'name' => 'Whiskey',
            'is_alcohol' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('food_types')->insert([
            'name' => 'CocaCola',
            'is_alcohol' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
