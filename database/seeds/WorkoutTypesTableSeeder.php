<?php

use Illuminate\Database\Seeder;

class WorkoutTypesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('workout_types')->insert([
      'name' => 'Run',
      'has_distance' => true,
      'color' => '#DF3915',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ]);

    DB::table('workout_types')->insert([
      'name' => 'Yoga',
      'color' => '#FF9500',
      'has_distance' => false,
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ]);

    DB::table('workout_types')->insert([
      'name' => 'Gym',
      'has_distance' => false,
      'color' => '#3167C6',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ]);
    DB::table('workout_types')->insert([
      'name' => 'Walk',
      'has_distance' => true,
      'color' => '#0C9A16',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ]);
    DB::table('workout_types')->insert([
      'name' => 'Badminton',
      'has_distance' => false,
      'color' => '#920793',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ]);
  }
}
