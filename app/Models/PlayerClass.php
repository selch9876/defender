<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlayerClass extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'name',
        'description',
        'base_health',
        'base_resistance',
        'base_attack',
        'base_defence',
        'special_ability',
        // add any other fields you want to store
    ];

    protected $sortable = [
        'name',
        'description',
        'base_health',
        'base_resistance',
        'base_attack',
        'base_defence',
        'special_ability',
        // add any other fields you want to store
    ];

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }
}
