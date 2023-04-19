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

    public function battleLogs()
    {
        return $this->hasMany(BattleLog::class);
    }

    // Methods
    public function getDefence()
    {
        return round($this->dex / 3);
    }
    public function getAttack()
    {
        return $this->playerClass->base_attack * 10;
    }

    public function castSpell(Character $target)
    {
        // Implementation of the castSpell method
    }

    public function giveDamage(int $damage)
    {
        // Reduce the character's HP by the amount of damage.
        $this->hp -= $damage;
        $this->save();

        // If the character's HP is now zero or negative, mark them as dead.
        if ($this->hp <= 0) {
            $this->is_dead = true;
            $this->save();
        }
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
