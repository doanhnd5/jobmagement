<?php

namespace App\Libs;

use Illuminate\Support\Facades\File;

class AssetHelper
{
    public static function cacheBusting(string $filePath): string
    {
        if (File::exists($filePath)) {
            $unixTimeStamp = File::lastModified($filePath);
            return "{$filePath}?{$unixTimeStamp}";
        }
        return $filePath;
    }
}
