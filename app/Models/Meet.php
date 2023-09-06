<?php

namespace App\Models;

use Database\Factories\MeetFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @class Meet
 * @property Collection $users
 */
class Meet extends Model
{
    use HasFactory;

    protected $table = 'meetings';

    protected $fillable = [
        'meeting_name', 'start_time', 'end_time',
    ];

    protected $casts = [
        'start_time' => 'date',
        'end_time' => 'date',
    ];

    protected static function newFactory(): MeetFactory
    {
        return MeetFactory::new();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'meeting_user', 'meet_id', 'user_id');
    }

    public function getInitialsAttribute(): array|string|null
    {
        return preg_filter('/[^A-Z]/', '', $this->attributes['meeting_name']);
    }
}
