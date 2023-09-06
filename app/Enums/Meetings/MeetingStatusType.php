<?php

namespace App\Enums\Meetings;

enum MeetingStatusType: string
{
    case Success = 'Meeting successfully attached';
    case Fail = 'Meeting cannot be attached';
}
