<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Gnireeg\LaravelTimezoned\HasTimezoneConversion;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory, HasTimezoneConversion;
    
    protected $timezonedAttributes = ['due_date'];

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'due_date',
        'is_completed',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'is_completed' => 'boolean',
    ];


    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function timeentries(): HasMany
    {
        return $this->hasMany(Timeentry::class);
    }
}
