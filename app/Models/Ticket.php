<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'category_id',
    ];



    protected function user()
    : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    : HasMany
    {
        return $this->hasMany(Comment::class, 'ticket_id');
    }

    public function assigned_agent()
    : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ticket_participants', 'ticket_id', 'user_id');
    }

    public function category()
    : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function files()
    : HasMany
    {
        return $this->hasMany(File::class, 'ticket_id');
    }
}
