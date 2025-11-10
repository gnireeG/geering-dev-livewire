<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TimezoneHelper
{
    /**
     * Convert a date to the user's display timezone
     */
    public static function toUserTimezone($date): Carbon
    {
        if (!$date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        $timezone = static::getUserTimezone();
        
        return $date->setTimezone($timezone);
    }

    /**
     * Convert a date from user timezone to UTC for database storage
     */
    public static function toUtc($date): Carbon
    {
        if (!$date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        return $date->utc();
    }

    /**
     * Get the current user's timezone or fallback to UTC
     */
    public static function getUserTimezone(): string
    {
        if (Auth::check()) {
            return Auth::user()->timezone ?? 'UTC';
        }
        
        return 'UTC';
    }

    /**
     * Get the display timezone (alias for getUserTimezone)
     */
    public static function getDisplayTimezone(): string
    {
        return static::getUserTimezone();
    }
}