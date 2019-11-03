#/bin/bash
php artisan migrate:fresh
php artisan db:seed --class=UsersTableSeeder
php artisan db:seed --class=TargetsTableSeeder
php artisan db:seed --class=WorkoutTypesTableSeeder
php artisan db:seed --class=WorkoutsTableSeeder
