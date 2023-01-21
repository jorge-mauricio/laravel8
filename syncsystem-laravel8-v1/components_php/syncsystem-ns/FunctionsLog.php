<?php
namespace SyncSystemNS;

use Illuminate\Support\Facades\Log;

class FunctionsLog
{
    // Log - laravel.
    // **************************************************************************************
    /**
     * Log - laravel.
     * @static
     * @param mixed $logData 
     * @param string $logType emergency | alert | critical | error | warning | notice | info | debug
     * @return void
     * @example
     * \SyncSystemNS\FunctionsDB::counterUniversalUpdate(1)
     */
    static function logLaravel(mixed $logData, string $logType = 'debug'): void
    {
        // ref: https://laravel.com/docs/9.x/logging#writing-log-messages
        Log::$logType($logData);
    }
    // **************************************************************************************
}