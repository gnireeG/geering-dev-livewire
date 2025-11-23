<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Gnireeg\LaravelTimezoned\HasTimezoneConversion;

class Meeting extends Model
{
    use HasFactory, HasTimezoneConversion;

    protected $timezonedAttributes = ['from', 'to'];

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




    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
