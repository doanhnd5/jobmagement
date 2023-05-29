<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class CustomizeFormatter
{
    private $logFormat = '[%datetime%] %level_name% %context% %message%' . PHP_EOL;
    private $dateFormat = 'Y/m/d H:i:s.u';

    public function __invoke($monolog)
    {
        $formatter = new LineFormatter($this->logFormat, $this->dateFormat, true, true);
        foreach ($monolog->getHandlers() as $handler) {
            $handler->setFormatter($formatter);
        }
    }
}
