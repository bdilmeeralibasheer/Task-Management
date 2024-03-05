<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            Task::query()->create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'priority' => $faker->numberBetween(1, 5),
                'due_date' => $faker->dateTimeBetween('+1 week', '+2 months'),
            ]);
        }
    }
}
