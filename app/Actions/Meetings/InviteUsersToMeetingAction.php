<?php

namespace App\Actions\Meetings;

use App\Dtos\Meetings\StoreMeetingData;
use App\Enums\Meetings\MeetingStatusType;
use App\Jobs\AttachMeetingJob;
use App\Models\Meet;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InviteUsersToMeetingAction
{
    public static function execute(StoreMeetingData $data): MeetingStatusType
    {
        // Here make the race condition check app/Rules/UsersAvailable rule to complement the validation logic around this
        try {
            Cache::lock('meetings')->block(10, function () use ($data) {
                DB::transaction(function () use ($data) {
                    AttachMeetingJob::dispatch($data->meeting_name, $data->start_time, $data->user_ids);
                });
            });
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            return MeetingStatusType::Fail;
        }

        return MeetingStatusType::Success;
    }
}
