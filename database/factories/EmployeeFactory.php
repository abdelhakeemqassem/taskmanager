<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'Abdelhakeem Qassem',
                'Ahmed Qassem',
                'Sameer Qassem',
                'Essam Qassem',
                'Youssief Qassem',
                'Hossam Qassem',
                'Sara Qassem'
            ]),
            'email' => $this->faker->unique()->randomElement([
                'employee@taskmanager.com',
                'ahmedqassem@taskmanager.com',
                'sameerqassem@taskmanager.com',
                'essamqassem@taskmanager.com',
                'youssiefqassem@taskmanager.com',
                'hossamqassem@taskmanager.com',
                'saraqassem@taskmanager.com',
            ]),
            'email_verified_at' => now(),
            'team_role'=>$this->faker->numberBetween(1,5),
            'password' => '$2y$10$GEVxtxmhj5/R.Fb48/J1b.GaQnolE/3nTtkJvP6QZkb2hDOrCeDey', //1->8
            'remember_token' => Str::random(10),
        ];
    }
}