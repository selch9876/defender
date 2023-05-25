<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'reward_gold',
        'reward_exp',
        'required_level',
    ];

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'character_quest')->withPivot('status');        
    }

    public function gameObjects()
    {
        return $this->hasMany(GameObject::class);        
    }

    public function mapObjects()
    {
        return $this->hasMany(MapObject::class);        
    }
}
