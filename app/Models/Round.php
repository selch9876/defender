<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Round extends Model
{
    use HasFactory;

    protected $fillable = ['fight_id', 'attacker_id', 'defender_id', 'attacker_type'];

    public function fight()
    {
        return $this->belongsTo(Fight::class);
    }

    public function attacker()
    {
        return $this->belongsTo(Character::class, 'attacker_id');
    }

    public function defender()
    {
        return $this->belongsTo(Monster::class, 'defender_id');
    }

    public function performAttack()
    {
        $damage = $this->attacker->giveDamage();

        $this->defender->takeDamage($damage);

        $this->save();
    }

    public function addTurn( $attacker,  $defender, $damage)
    {
        $this->attacker_id = $attacker->id;
        $this->defender_id = $defender->id;
        $this->save();
    }

    public function getAttacker()
    {
        return Character::find($this->attacker_id);
    }

    public function getDefender()
    {
        return Monster::find($this->defender_id);
    }

    public function isInProgress()
    {
        // Get the current round number for the fight
        $currentRoundNumber = $this->fight->getCurrentRound();

        // If this round number is the same as the current round number, the round is in progress
        return $currentRoundNumber;
    }
}

