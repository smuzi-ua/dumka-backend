<?php

namespace App\Models;

use Database\Factories\SchoolFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class School extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected static function newFactory()
    {
        return SchoolFactory::new();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
