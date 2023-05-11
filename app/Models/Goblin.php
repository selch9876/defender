<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goblin extends Model
{
    use HasFactory;

    protected $table = 'monsters';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['name'] = 'Goblin';
        $this->attributes['level'] = 1;
        $this->attributes['health'] = 10;
        $this->attributes['damage'] = 2;
        $this->attributes['xp'] = 10;
        $this->attributes['gold'] = 5;
    }
}
