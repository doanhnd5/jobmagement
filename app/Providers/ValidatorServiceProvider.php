<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Libs\SystemUtil;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('max_utf8', function ($attribute, $value, $parameters, $validator) {
            if (array_key_exists(0, $parameters)) {
                $validator->addReplacer('max_utf8', function ($message, $attribute, $rule, $parameters) {
                    $maxLength = $parameters[0];
                    $msg = $message;
                    $msg = str_replace([':max'], $maxLength, $msg);
                    return $msg;
                });
                $maxLength = $parameters[0];
                return (mb_strlen($value, 'UTF-8') <= $maxLength);
            }
            return true;
        });

        Validator::extend('start_to_end_time_diff', function ($attribute, $value, $parameters, $validator) {
            if (!empty($value) && !empty($parameters[0])) {
                $startTime = str_replace(':', '', $value);
                $endTime   = str_replace(':', '', $parameters[0]);
                $startTimeInSeconds = SystemUtil::convertHHIISSToSecond($startTime);
                $endTimeInSeconds   = SystemUtil::convertHHIISSToSecond($endTime);
                return $startTimeInSeconds < $endTimeInSeconds;
            }
            return true;
        });

        Validator::extend('array_length', function ($attribute, $value, $parameters, $validator) {
            $ret = true;
            if ((gettype($value) == 'array' && count($value) > 0) == false) {
                $ret = false;
            }
            return $ret;
        });
    }
}
