<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
    ];

    public function department()
    : BelongsTo
    {
        return $this->belongsTo(Category::class, 'department_id');
    }
}
