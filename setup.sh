#/bin/bash
php artisan migrate:fresh
php artisan db:seed --class=UsersTableSeeder
php artisan db:seed --class=TargetsTableSeeder
