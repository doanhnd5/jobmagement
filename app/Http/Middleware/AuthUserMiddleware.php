<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Consts\SessionConst;
use App\Consts\ScreenConst;
use App\Consts\SystemConst;
use App\Libs\SessionManager;
use App\Libs\SystemUtil;
use Session;

class AuthUserMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (SessionManager::isLogin()) {
            return $next($request);
        }
        return redirect('login');
    }
}
