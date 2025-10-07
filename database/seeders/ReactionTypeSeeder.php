<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReactionType;

class ReactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reactions = [
            ['name' => 'Like'],
            ['name' => 'Love'],
            ['name' => 'Care'],
            ['name' => 'Haha'],
            ['name' => 'Wow'],
            ['name' => 'Sad'],
            ['name' => 'Angry'],
        ];

        foreach ($reactions as $reaction) {
            ReactionType::create($reaction);
        }
    }
}
