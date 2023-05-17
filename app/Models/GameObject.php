<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameObject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'x', 'y'];

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function quests()
    {
        return $this->belongsToMany(Quest::class);
    }
}
