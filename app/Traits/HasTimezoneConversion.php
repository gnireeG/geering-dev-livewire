<?php

namespace App\Traits;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;

trait HasTimezoneConversion
{
    /**
     * Convert datetime attributes to user's timezone for DISPLAY ONLY
     * 
     * @param string $attribute
     * @param mixed $value
     * @return \Carbon\Carbon|null
     */
    protected function convertToUserTimezone($attribute, $value)
    {
        if (!$value) return null;
        
        $datetime = $this->asDateTime($value);
        $userTimezone = auth()->user()?->timezone ?? 'UTC';
        
        return $datetime->setTimezone($userTimezone);
    }
    
    /**
     * Get the list of attributes that should be converted to user timezone
     * Override this method in your model to specify which datetime fields to convert
     * 
     * @return array
     */
    protected function getTimezoneConvertedAttributes(): array
    {
        return [];
    }
    
    /**
     * Dynamically create timezone conversion accessors (UTC -> User timezone)
     * ONLY for display - NO automatic saving conversion
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        
        if (in_array($key, $this->getTimezoneConvertedAttributes()) && $value instanceof \Carbon\Carbon) {
            return $this->convertToUserTimezone($key, $value);
        }
        
        return $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->getTimezoneConvertedAttributes()) && $value instanceof \Carbon\Carbon) {
            $newDate = Carbon::parse($value)->shiftTimezone(auth()->user()?->timezone ?? 'UTC')->setTimezone('UTC');
            return parent::setAttribute($key, $newDate);
        }
        
        return parent::setAttribute($key, $value);
    }
}