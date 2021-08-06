<?php

namespace App\Models;

use App\Enums\VoteType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'verified_at'       => 'datetime',
        'verification_code' => 'encrypted',
    ];

    protected $appends = ['is_verified'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function verify(): self
    {
        $this->verified_at       = now();
        $this->verification_code = null;
        $this->save();

        return $this;
    }

    public function vote(string $type, Proposal $proposal): Vote
    {
        return $this
            ->votes()
            ->firstOrCreate([
                'proposal_id' => $proposal->getKey(),
                'type'        => $type,
            ]);
    }

    public function isTeacher(): bool
    {
        return $this->is_teacher;
    }

    public function scopeHasTeacherRole($query)
    {
        return $query->where('is_teacher', true);
    }

    public function getIsVerifiedAttribute(): bool
    {
        return $this->verified_at !== null;
    }
}
