<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['name'];

    /** @todo Roles */
    public function students()
    {
        return $this->hasMany(User::class);
    }
}
