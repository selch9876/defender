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
}
