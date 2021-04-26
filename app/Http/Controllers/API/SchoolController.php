<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SchoolResource;
use App\Models\School;
use Spatie\RouteAttributes\Attributes\Get;

final class SchoolController
{
    #[Get('/schools', name: "schools.index")]
    public function index()
    {
        return SchoolResource::collection(School::all());
    }
}
