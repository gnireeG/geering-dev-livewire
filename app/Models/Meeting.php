<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTimezoneConversion;

class Meeting extends Model
{
    use HasFactory, HasTimezoneConversion;

    protected $fillable = [
        'title',
        'description',
        'from',
        'to',
        'company_id',
        'project_id',
        'location',
    ];

    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Specify which datetime fields should be converted to user's timezone
     */
    protected function getTimezoneConvertedAttributes(): array
    {
        return ['from', 'to', 'created_at', 'updated_at'];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
