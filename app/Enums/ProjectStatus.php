<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case PLANNING = 'planning';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case ON_HOLD = 'on_hold';
    case CANCELLED = 'cancelled';

    /**
     * Get all enum values as an array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all enum names as an array
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get a comma-separated string of values (useful for validation rules)
     */
    public static function implode(string $separator = ','): string
    {
        return implode($separator, self::values());
    }

    /**
     * Get a human-readable label for the status
     */
    public function label(): string
    {
        return match($this) {
            self::PLANNING => 'Planning',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
            self::ON_HOLD => 'On Hold',
            self::CANCELLED => 'Cancelled',
        };
    }

    /**
     * Get a color class for the status (for badges, etc.)
     */
    public function color(): string
    {
        return match($this) {
            self::PLANNING => 'blue',
            self::IN_PROGRESS => 'yellow',
            self::COMPLETED => 'green',
            self::ON_HOLD => 'gray',
            self::CANCELLED => 'red',
        };
    }
}