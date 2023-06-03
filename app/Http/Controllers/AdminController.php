<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidates;
use App\Consts\ScreenConst;
use App\Libs\SessionManager;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (SessionManager::isLogin()) {
            return redirect('candidates');
        }
        return redirect('login.index');
    }
}
