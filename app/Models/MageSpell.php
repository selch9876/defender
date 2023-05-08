<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MageSpell extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'name',
        'level',
        'dice',
        'mc',
    ];

    protected $sortable = [
        'name',
        'level',
        'dice',
        'mc',
    ];

    public function characters()
    {
        return $this->belongsToMany(Character::class)->withTimestamps();
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    //Methods 

    public function calculateDamage()
    {
        $dice = $this->dice ?? '1d6'; // default to 1d6 if no dice specified
        $rolls = collect(explode('d', $dice))->map(fn($n) => intval($n)); // split dice string into number of rolls and dice sides
        $result = 0;
        for ($i = 0; $i < $rolls[0]; $i++) {
            $result += rand(1, $rolls[1]); // roll the dice and add to result
        }
        return $result;
    }
}
