<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasTimezoneConversion;

class Email extends Model
{

    use hasFactory, HasTimezoneConversion;

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

    protected function getTimezoneConvertedAttributes(): array
    {
        return ['sent_at', 'created_at', 'updated_at'];
    }

}
