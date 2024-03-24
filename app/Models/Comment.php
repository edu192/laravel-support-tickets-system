<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $fillable = [
        'description', 'ticket_id', 'user_id',
    ];

    protected function ticket()
    : BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    protected function user()
    : BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
