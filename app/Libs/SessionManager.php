<?php

namespace App\Libs;

use Session;

use App\Consts\SessionConst;
use App\Traits\LogTrait;

class SessionManager
{
    use LogTrait;

    public static function clearLoginSession()
    {
        Session::forget(SessionConst::SESSION_KEY_LOGIN_SYSTEM_USER_ID);
    }

    public static function getLoginSystemUserId()
    {
        return Session::get(SessionConst::SESSION_KEY_LOGIN_SYSTEM_USER_ID);
    }

    public static function setLoginSystemUserId($pLoginSystemUserId)
    {
        Session::put(SessionConst::SESSION_KEY_LOGIN_SYSTEM_USER_ID, $pLoginSystemUserId);
    }

    public static function isLogin()
    {
        return Session::has(SessionConst::SESSION_KEY_LOGIN_SYSTEM_USER_ID);
    }
}
