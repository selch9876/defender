<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MageSpell extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'damage',
        'mc',
    ];

    public function character()
    {
        return $this->belongsToMany(Character::class)->withTimestamps();
    }
}
