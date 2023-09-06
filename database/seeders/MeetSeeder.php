<?php

namespace Database\Seeders;

use App\Models\Meet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meeting = Meet::factory()->create([
            'meeting_name' => 'Coffee time meet',
        ]);

        User::query()->get()->each(static function (User $user) use ($meeting) {
            $user->meets()->attach($meeting->id);
        });

        $anotherMeeting = Meet::factory()->create([
            'meeting_name' => 'Some important Meet',
        ]);

        User::query()->limit(2)->get()->each(static function (User $user) use ($anotherMeeting) {
            $user->meets()->attach($anotherMeeting->id);
        });
    }
}
