<?php

namespace Database\Seeders;

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
        \App\Models\Role::factory(5)->create();
        \App\Models\Admin::factory(1)->create();
        \App\Models\Employee::factory(7)->create();
    }
}
