<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Gnireeg\LaravelTimezoned\HasTimezoneConversion;

class Timeentry extends Model
{

    use HasTimezoneConversion;
    
    protected $timezonedAttributes = ['start_time', 'end_time'];

    protected $fillable = [
        'task_id',
        'start_time',
        'end_time',
        'notes',
        'completed',
        'total_seconds',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'completed' => 'boolean',
    ];


    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
