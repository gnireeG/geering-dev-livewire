<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasTimezoneConversion;

class Timeentry extends Model
{

    use HasTimezoneConversion;

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

    protected function getTimezoneConvertedAttributes(): array
    {
        return ['start_time', 'end_time', 'created_at', 'updated_at'];
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
