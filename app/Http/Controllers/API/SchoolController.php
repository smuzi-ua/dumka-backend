<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SchoolResource;
use App\Models\School;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Resource;

/** @group Schools */
#[Prefix('/api/v1')]
#[Resource('schools', only: ['index'])]
final class SchoolController
{
    /** Get a list of schools */
    public function index()
    {
        return SchoolResource::collection(School::all());
    }
}
