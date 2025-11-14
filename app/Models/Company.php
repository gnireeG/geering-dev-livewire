<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'customer',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'website',
        'notes',
    ];

    protected $casts = [
        'customer' => 'boolean',
    ];

    /**
     * Apply default ordering by name
     */
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('name');
        });
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }
}
