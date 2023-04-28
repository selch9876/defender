<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dragon extends Monster
{
    use HasFactory;

    protected $table = 'monsters';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['name'] = 'Dragon';
        $this->attributes['level'] = 50;
        $this->attributes['health'] = 500;
        $this->attributes['damage'] = 10;
        $this->attributes['xp'] = 500;
    }
}
