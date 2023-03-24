<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattleLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'enemy_id',
        'experience_gained',
        'gold_gained',
        'start_time',
        'end_time',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function enemy()
    {
        return $this->belongsTo(Enemy::class);
    }
}
