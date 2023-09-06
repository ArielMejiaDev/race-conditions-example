<?php

namespace App\Dtos\Meetings;

use App\Http\Requests\Meetings\StoreMeetingRequest;
use Illuminate\Http\Request;

class StoreMeetingData
{
    public function __construct(
        public readonly string $meeting_name,
        public readonly string $start_time,
        public readonly array $user_ids
    ) {}

    public static function fromRequest(StoreMeetingRequest $request): StoreMeetingData
    {
        return new self(
            meeting_name: $request->validated('meeting_name'),
            start_time: $request->date('start_time'),
            user_ids: $request->validated('user_ids'),
        );
    }
}
