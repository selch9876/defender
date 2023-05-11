<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rat extends Model
{
    use HasFactory;

    protected $table = 'monsters';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['name'] = 'Rat';
        $this->attributes['level'] = 1;
        $this->attributes['health'] = 5;
        $this->attributes['damage'] = 1;
        $this->attributes['xp'] = 5;
        $this->attributes['gold'] = 2;
    }
}
