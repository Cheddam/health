<?php

use Illuminate\Database\Seeder;

use App\Category;
use App\Goal;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'The Basics', 'weight' => 1],
            ['name' => 'Bonus Points', 'weight' => 2],
        ];

        $goals = [
            ['name' => 'Slept 6-8 hours last night', 'points' => 10, 'weight' => 1, 'category_id' => 1],
            ['name' => 'Exercised for at least 30 mins', 'points' => 10, 'weight' => 2, 'category_id' => 1],
            ['name' => 'Drank at least 4 glasses of water', 'points' => 10, 'weight' => 3, 'category_id' => 1],
            ['name' => 'Ate a healthy lunch', 'points' => 10, 'weight' => 4, 'category_id' => 1],
            ['name' => 'Purposeful exercise (run, gym, etc.)', 'points' => 15, 'weight' => 1, 'category_id' => 2],
            ['name' => 'Ate home-cooked dinner', 'points' => 15, 'weight' => 2, 'category_id' => 2],
            ['name' => 'Avoided caffeine', 'points' => 15, 'weight' => 3, 'category_id' => 2],
            ['name' => 'Avoided refined sugar (treats)', 'points' => 15, 'weight' => 4, 'category_id' => 2],
            ['name' => 'Took 2 or more breaks from screen', 'points' => 15, 'weight' => 5, 'category_id' => 2],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        foreach ($goals as $goal) {
            Goal::create($goal);
        }
    }
}
