<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'health',
        'damage'
    ];

    public function fights()
    {
        return $this->hasMany(Fight::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class, 'defender_id');
    }

    /**
     * Inflict damage on the character.
     *
     * @param int $damage
     * @return void
     */
    public function takeDamage(int $damage)
    {
        $this->health -= $damage;
        if ($this->health < 0) {
            $this->health = 0;
        }
        $this->save();
    }

    public function attack()
    {
        $attackPower = $this->damage * rand(1, 10);
        return $attackPower;
    }

    public function isDead()
    {
        return $this->health <= 0;
    }
}
