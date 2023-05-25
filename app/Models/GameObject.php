<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameObject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'x', 'y', 'quest_id'];

    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);
    //     $this->attributes['name'] = 'Scroll';
    //     $this->attributes['x'] = rand(0, 3);
    //     $this->attributes['y'] = rand(0, 3);
    // }

    public function image()
    {
        return $this->hasOne(Image::class, 'game_object_id');
    }

    public function quests()
    {
        return $this->belongsToMany(Quest::class);
    }
}
