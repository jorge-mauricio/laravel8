<?php

declare(strict_types=1);

namespace SyncSystemNS;

use Illuminate\Support\Facades\Log;

class FunctionsLog
{
    // Log - laravel.
    // **************************************************************************************
    /**
     * Log - laravel.
     * @static
     * @see https://laravel.com/docs/9.x/logging#writing-log-messages
     * @param mixed $logData
     * @param string $logType emergency | alert | critical | error | warning | notice | info | debug | clear
     * @return void
     * @example
     * \SyncSystemNS\FunctionsLog::logLaravel($logData, 'debug');
     */
    public static function logLaravel(mixed $logData, string $logType = 'debug'): void
    {
        Log::$logType($logData);

        // Clear.
        // file_put_contents(storage_path('logs/laravel.log'),'');
        // ref: https://stackoverflow.com/questions/28127495/in-phps-laravel-how-do-i-clear-laravel-log
    }
    // **************************************************************************************
}
