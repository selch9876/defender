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

    public function addTurn(Character $attacker, Character $defender, $damage)
    {
        $this->turns()->create([
            'attacker_id' => $attacker->id,
            'defender_id' => $defender->id,
            'damage' => $damage
        ]);
    }
}

