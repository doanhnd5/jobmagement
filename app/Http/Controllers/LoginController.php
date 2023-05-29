<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MstUser;
use App\Libs\SessionManager;

class LoginController extends Controller
{
    public function index()
    {
        return view('layout.pages.login');
    }

    public function login(Request $request)
    {
        try {
            $email    = $request->email;
            $password = $request->password;
            $validateRules = [
                'email'    => 'required',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $validateRules);
            if ($validator->fails()) {
                return redirect('login')->withInput()->withErrors($validator);
            }
            $user = MstUser::where('email', '=', $email)->where('password', '=', $password);
            if ($user->exists()) {
                SessionManager::setLoginSystemUserId($user->first()['id']);
                return redirect('candidates');
            }
            $errorMsg = __('messages.E0001', ['attribute' => 'Đăng nhập']);
            return redirect('login')->withInput()->withErrors(['login_fail' => $errorMsg]);
        } catch (\Exeption $ex) {
            return view('errors.index');
        }
    }
}
