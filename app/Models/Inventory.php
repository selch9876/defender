<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

}
