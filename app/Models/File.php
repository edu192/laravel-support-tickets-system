<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    protected $fillable = [
        'name', 'ticket_id',
    ];

    protected function ticket()
    : BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
