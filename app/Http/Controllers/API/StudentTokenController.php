<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Middleware\SubstituteBindings;
use Spatie\RouteAttributes\Attributes\Post;

class StudentTokenController
{
    #[Post('students/{student}/token', middleware: SubstituteBindings::class)]
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    }
}
