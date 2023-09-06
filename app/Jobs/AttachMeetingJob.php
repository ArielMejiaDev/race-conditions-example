<?php

namespace App\Jobs;

use App\Models\Meet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AttachMeetingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $meeting_name, public string $start_time, public array $user_ids)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var Meet $meet */
        $meet = Meet::query()->create([
            'meeting_name' => $this->meeting_name,
            'start_time' => $this->start_time,
            'end_time' => now()->addWeek(),
        ]);

        $meet->users()->attach($this->user_ids);
    }
}
