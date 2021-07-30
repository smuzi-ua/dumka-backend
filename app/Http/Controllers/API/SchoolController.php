<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SchoolResource;
use App\Models\School;
use Spatie\RouteAttributes\Attributes\{Get, Prefix};

/** @group Schools */
#[Prefix('/api/v1')]
final class SchoolController
{
    /** Get a list of schools */
    #[Get('/schools', name: 'schools.index')]
    public function index()
    {
        return SchoolResource::collection(School::all());
    }
}
