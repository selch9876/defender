<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = ['fight_id', 'number', 'description', 'damage', 'result'];

    const TYPE_CHARACTER = 'character';
    const TYPE_ENEMY = 'enemy';

    public function fight()
    {
        return $this->belongsTo(Fight::class);
    }
}
