<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MstUser;
use App\Libs\SessionManager;
use Illuminate\Support\Facades\DB;
use App\Consts\ScreenConst;

class LoginController extends Controller
{
    public function index()
    {
        SessionManager::clearLoginSession();
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

    public function changePassword(Request $request)
    {
        try {
            $userInfor = [
                'email'             => $request->email,
                'current_password'  => $request->current_password,
                'new_password'      => $request->new_password,
            ];
            logger($request);
            $validationRules = [
                'email'             => ['bail', 'required', 'email', 'max_utf8:255'],
                'current_password'  => ['bail', 'required', 'max_utf8:255'],
                'new_password'      => ['bail', 'required', 'different:current_password' ,'max_utf8:255'],
            ];
            $validator = Validator::make($userInfor, $validationRules);
            if ($validator->fails()) {
                $errors = [
                    'status'   => ScreenConst::PROCESS_STATUS_ERROR,
                    'alertMsg' => __('messages.E0002'),
                    'errorMsg' => json_decode($validator->messages()),
                ];
                logger($errors);
                return response()->json($errors);
            }
            logger("test");
            $email           = $request->email;
            $currentPassword = $request->current_password;
            $user = MstUser::where('email', '=', $email)->where('password', '=',  $currentPassword);
            if (!$user->exists()) {
                $data = [
                    'status'   => ScreenConst::PROCESS_STATUS_SYSTEM_ERROR,
                    'url'      => route('login.index'),
                    'alertMsg' => __('messages.EM004', ['attribute' => 'admin']),
                ];
                return response()->json($data);
            }

            // Update
            $paramUpdate = [];
            $this->setParamUpdateInfoCommon($paramUpdate);
            $paramUpdate['password'] = $request->new_password;
            // Begin transaction
            DB::beginTransaction();
            $user->update($paramUpdate);
            // Commit
            DB::commit();
            $data = [
                'status'   => ScreenConst::PROCESS_STATUS_SUCCESS,
                'alertMsg' => __('messages.I0002', ['attribute1' => 'Thay đổi', 'attribute2' => 'mật khẩu'])
            ];
            return response()->json($data);
        } catch (\Exeption $ex) {
            DB::rollBack();
            $data = [
                'status'   => ScreenConst::PROCESS_STATUS_SYSTEM_ERROR,
                'alertMsg' => __('messages.E0001', ['attribute' => 'Thay đổi mật khẩu']),
            ];
            return response()->json($data);
        }
    }
}
