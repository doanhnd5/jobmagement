<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use ReflectionClass;

use App\Libs\SessionManager;

trait LogTrait
{
    /**
     * Error Log
     *
     * @param  string $messageId
     * @param  string $messageContent
     * @return void
     */
    protected function errorLog($messageId, $messageContent)
    {
        Log::channel('kyujin_apl')->error($this->createMessageLog($messageId, $messageContent, false));
        Log::channel('kyujin_debug')->error($this->createMessageLog($messageId, $messageContent, true));
    }

    /**
     * Create Message Format
     *
     * @param  string  $pMessageId
     * @param  string  $pMessage
     * @param  boolean $pIsDebug
     * @return string  $message
     */
    private function createMessageLog($pMessageId, $pMessage, $pIsDebug)
    {
        $message = "";

        $messageDescription = str_replace(array("\r", "\n"), " ", $pMessage);
        if ($pIsDebug) {
            $messageDescription = $pMessage;
        }

        $massageArray = [];
        array_push($massageArray, $this->getUserIdLog(), $this->createMessageLogCallerFunction(), $pMessageId, $messageDescription);
        $message = "\t" . implode("\t", $massageArray);
        return $message;
    }

    /**
     * Get login user information
     *
     * @return string  $userId
     */
    private function getUserIdLog()
    {
        $userId = "";
        $userId = SessionManager::getLoginSystemUserCode();
        return $userId;
    }

    /**
     * @return string $message
     */
    private function createMessageLogCallerFunction()
    {
        return $this->getCallerClassNameLog() . "@" . $this->getCallerFunctionNameLog();
    }

    /**
     *
     * @return string $className
     */
    protected function getCallerClassNameLog()
    {
        $className = (new ReflectionClass($this))->getShortName();
        return $className;
    }

    /**
     *
     * @return string $callFunctionName
     */
    private function getCallerFunctionNameLog()
    {
        $callAction = explode("@", Route::currentRouteAction());
        $callFunctionName = $callAction[1];
        return $callFunctionName;
    }

    /**
     * Format Exeption Log
     *
     * @param  \Exception $pException
     * @return string
     */
    protected function formatExceptionLog(Exception $pException)
    {
        return get_class($pException) . ' ' . $pException->getMessage();
    }
}
