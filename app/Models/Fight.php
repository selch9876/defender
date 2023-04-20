<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'monster_id',
        'current_round',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enemy()
    {
        return $this->belongsTo(Enemy::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function getNextRound()
    {
        return $this->rounds()->max('number') + 1;
    }

    public function getCurrentRound()
    {
        return $this->rounds()->findOrFail($this->current_round);
    }


    
}
