<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'name',
        'description',
        'value',
        'rarity',
        'type',
        'dice',
    ];

    protected $sortable = [
        'name',
        'description',
        'value',
        'rarity',
        'type',
        'dice',
    ];

    public function characters()
    {
        return $this->belongsToMany(Character::class)->withPivot('quantity');
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function damage()
    {
        // Calculate damage based on weapon type and other factors

        $damage = $this->dice ?? '1d6'; // default to 1d6 if no dice specified
        $rolls = collect(explode('d', $damage))->map(fn($n) => intval($n)); // split dice string into number of rolls and dice sides
        $result = 0;
        for ($i = 0; $i < $rolls[0]; $i++) {
            $result += rand(1, $rolls[1]); // roll the dice and add to result
        }
        return $result;
    }
}


