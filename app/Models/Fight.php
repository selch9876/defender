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

    public function monster()
    {
        return $this->belongsTo(Monster::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
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

    public function winner()
    {
        $monsterHealth = $this->monster->health;
        $charactersHealth = $this->character->sum('hp');

        if ($monsterHealth > 0 && $charactersHealth > 0) {
            // The fight is still ongoing, so return null
            return null;
        } elseif ($monsterHealth <= 0 && $charactersHealth <= 0) {
            // All characters and the monster are dead, so return null
            return null;
        } elseif ($monsterHealth <= 0) {
            // The monster is dead, so return the characters as the winner
            return $this->character;
        } else {
            // All characters are dead, so return the monster as the winner
            return $this->monster;
        }
    }

    public function loser()
    {
        $monsterHealth = $this->monster->health;
        $charactersHealth = $this->character->sum('hp');

        if ($monsterHealth > 0 && $charactersHealth > 0) {
            // The fight is still ongoing, so return null
            return null;
        } elseif ($monsterHealth <= 0 && $charactersHealth <= 0) {
            // All characters and the monster are dead, so return null
            return null;
        } elseif ($monsterHealth <= 0) {
            // The monster is dead, so return the characters as the winner
            return $this->monster;
        } else {
            // All characters are dead, so return the monster as the winner
            return $this->character;
        }
    }


    
}
