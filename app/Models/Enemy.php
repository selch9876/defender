<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enemy extends Model
{
    use HasFactory;

    protected $name;
    protected $health;
    protected $damage;
    protected $experience;

    public function __construct($name, $health, $damage, $experience)
    {
        $this->name = $name;
        $this->health = $health;
        $this->damage = $damage;
        $this->experience = $experience;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getDamage()
    {
        return $this->damage;
    }

    public function getExperience()
    {
        return $this->experience;
    }

    public function takeDamage($amount)
    {
        $this->health -= $amount;

        if ($this->health < 0) {
            $this->health = 0;
        }
    }

    public function isDead()
    {
        return $this->health <= 0;
    }

    public function battleLogs()
    {
        return $this->hasMany(BattleLog::class);
    }

    public function quests()
    {
        return $this->hasMany(Quest::class);
    }

    
}
