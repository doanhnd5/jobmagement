<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Libs\SessionManager;
use Session;

class ClearSessionMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        SessionManager::clearLoginSession();
        return $next($request);
    }
}
