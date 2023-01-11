<?php

namespace Database\Seeders;

use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 20) as $userId) {
            foreach (range(1, 100) as $ideaId) {
                if ($ideaId % 2 === 0) {
                    Vote::factory()->create([
                        'user_id' => $userId,
                        'idea_id' => $ideaId
                    ]);
                }
            }
        }
    }
}
