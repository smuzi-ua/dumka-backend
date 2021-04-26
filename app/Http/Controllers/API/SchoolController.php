<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SchoolResource;
use App\Models\School;

final class SchoolController
{
    public function index()
    {
        return SchoolResource::collection(School::all());
    }
}
