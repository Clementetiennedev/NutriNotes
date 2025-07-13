<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight',
        'calories',
        'steps',  // ← Il faut que 'steps' soit dans fillable !
        'notes',
        'date'
    ];

    protected $casts = [
        'date' => 'date',
        'weight' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}