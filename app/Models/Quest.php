<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'experience_reward',
        'item_reward',
        'enemy_id',
        'target_amount',
        // add any other fields you want to store
    ];

    public function enemy()
    {
        return $this->belongsTo(Enemy::class);
    }
}
