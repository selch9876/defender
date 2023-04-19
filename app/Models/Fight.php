<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'enemy_id',
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

    public function attack($attacker, $defender)
    {
        // Calculate damage and apply it to the defender
        $damage = $attacker->getDamage();
        $defender->takeDamage($damage);

        // Check if the defender is still alive
        if ($defender->isAlive()) {
            // Switch the attacker and defender and start the next round
            $this->nextRound($defender, $attacker);
        } else {
            // The defender is defeated, end the fight
            $this->status = 'completed';
            $this->save();
        }
    }

    
}
