#/bin/bash
php artisan migrate:fresh
php artisan db:seed --class=UsersTableSeeder
php artisan db:seed --class=TargetsTableSeeder
php artisan db:seed --class=WorkoutTypesTableSeeder
php artisan db:seed --class=WorkoutsTableSeeder
php artisan db:seed --class=SleepsTableSeeder
php artisan db:seed --class=MoodsTableSeeder
php artisan db:seed --class=WeightsTableSeeder
