<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use App\Libs\SessionManager;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private Carbon $processDatetime;

    public function __construct()
    {
        $this->processDatetime = Carbon::now();
    }

    protected function setDdlEmptyDataNullable($pDdlList, $defaultValue)
    {
        $ret     = [];
        $ret[""] = $defaultValue;
        foreach ($pDdlList as $pDdlKey => $pDdlVal) {
            $ret[$pDdlKey] = $pDdlVal;
        }
        return $ret;
    }

    protected function setParamCreateInfoCommon(&$pParam, $isUpdate = true)
    {
        $pParam['create_datetime'] = $this->processDatetime;
        $pParam['create_user']     = SessionManager::getLoginSystemUserId();
        if ($isUpdate) {
            $this->setParamUpdateInfoCommon($pParam);
        }
    }

    protected function setParamUpdateInfoCommon(&$pParam)
    {
        $pParam['update_datetime'] = $this->processDatetime;
        $pParam['update_user']     = SessionManager::getLoginSystemUserId();
    }

    protected function isAlreadyUpdated($request, $targetData)
    {
        $ret = ((new Carbon($request->date_time_display))->diff($targetData->update_datetime)->invert == 0);
        return $ret;
    }
}
