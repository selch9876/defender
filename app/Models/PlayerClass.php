<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'base_health',
        'base_resistance',
        'base_attack',
        'base_defense',
        'special_ability',
        // add any other fields you want to store
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
