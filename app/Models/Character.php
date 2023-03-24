<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'class',
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
        return $this->belongsTo(PlayerClass::class);
    }

    public function battleLogs()
    {
        return $this->hasMany(BattleLog::class);
    }

    // Methods
    public function attack(Character $target)
    {
        // Implementation of the attack method
    }

    public function defend()
    {
        // Implementation of the defend method
    }

    public function castSpell(Character $target)
    {
        // Implementation of the castSpell method
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
