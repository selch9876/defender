<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orc extends Monster
{
    use HasFactory;

    protected $table = 'monsters';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['name'] = 'Orc';
        $this->attributes['level'] = 5;
        $this->attributes['health'] = 120;
        $this->attributes['damage'] = 3;
    }
}
