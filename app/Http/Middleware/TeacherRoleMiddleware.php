<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class TeacherRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless($request->user()->isTeacher(), 403);

        return $next($request);
    }
}
