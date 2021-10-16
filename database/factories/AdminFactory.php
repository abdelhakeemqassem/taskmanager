<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'admin taskmanager',
            'email' => 'abdelhakeemqassem@taskmanager.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$GEVxtxmhj5/R.Fb48/J1b.GaQnolE/3nTtkJvP6QZkb2hDOrCeDey', //1->8
            'remember_token' => Str::random(10),
        ];
    }
}