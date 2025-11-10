<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{

    use hasFactory;

    protected $fillable = [
        'subject',
        'recipients',
        'cc',
        'bcc',
        'body',
        'body_text',
        'sent_at',
        'status',
        'reply_status',
        'company_id',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get created_at in user timezone
     */
    public function getCreatedAtUserAttribute()
    {
        return \App\Helpers\TimezoneHelper::toUserTimezone($this->created_at);
    }

    /**
     * Get updated_at in user timezone  
     */
    public function getUpdatedAtUserAttribute()
    {
        return \App\Helpers\TimezoneHelper::toUserTimezone($this->updated_at);
    }

    /**
     * Get sent_at in user timezone
     */
    public function getSentAtUserAttribute()
    {
        return $this->sent_at ? \App\Helpers\TimezoneHelper::toUserTimezone($this->sent_at) : null;
    }

}
