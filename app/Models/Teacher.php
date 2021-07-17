<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'period',
    ];

    public function period(): BelongsToMany
    {
        return $this->belongsToMany(Period::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
