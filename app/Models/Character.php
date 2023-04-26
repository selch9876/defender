<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'xp',
        'level',
        'hp',
        'mp',
        'str',
        'dex',
        'int',
        'class_id',
    ];

    
    
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playerClass()
    {
        return $this->belongsTo(PlayerClass::class, 'class_id');
    }

    public function fights()
    {
        return $this->hasMany(Fight::class);
    }

    public function mageSpells()
    {
        return $this->hasMany(MageSpell::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class, 'attacker_id');
    }

    // Methods
    public function getDefence()
    {
        return round($this->dex / 3);
    }

    public function castSpell(Character $mageSpell)
    {
        // Implementation of the castSpell method
        $spellPower = $mageSpell->damage * $this->level;
        return $spellPower;
    }

    /**
     * Inflict damage on the character.
     *
     * @param int $damage
     * @return void
     */
    public function takeDamage(int $damage)
    {
        $this->hp -= $damage;
        if ($this->hp < 0) {
            $this->hp = 0;
        }
        $this->save();
    }

    public function heal($heal)
    {
        $this->hp += $heal;
        
        $this->save();
        return $heal;
    }

    public function attack()
    {
        $attackPower = $this->playerClass->base_attack * rand(10, 20);
        return $attackPower;
    }

    public function isDead()
    {
        return $this->hp <= 0;
    }

    public function levelUp()
    {
        $this->level++;
        $this->hp += 10; // Increase health points by 10
        $this->mp += 5; // Increase magic points by 5
        $this->str += 2; // Increase strength by 2
        $this->dex += 2; // Increase dexterity by 2
        $this->int += 2; // Increase intelligence by 2
    }

    
}
