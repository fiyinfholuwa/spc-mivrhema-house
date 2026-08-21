<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['is_overflow' => 'boolean'];
    }

    public function keyLogs(): HasMany
    {
        return $this->hasMany(RoomKeyLog::class);
    }

    public function activeKeyLog(): HasOne
    {
        return $this->hasOne(RoomKeyLog::class)->whereNull('returned_at')->latestOfMany('collected_at');
    }

    public function members(): HasMany
    {
        return $this->hasMany(RoomMember::class);
    }

    public function activeMembers(): HasMany
    {
        return $this->members()->whereNull('exited_at');
    }
}
