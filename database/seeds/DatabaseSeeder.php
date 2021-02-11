<?php

use App\User;
use App\Admin;
use App\Teacher;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 10)->create();
        factory(Admin::class, 10)->create();
        factory(Teacher::class, 5)->create();
    }
}
