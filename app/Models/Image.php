<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'item_id', 'mage_spell_id', 'player_class_id', 'monster_id', 'game_object_id'];

    public function url()
    {
        return Storage::url($this->path);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function mageSpell()
    {
        return $this->belongsTo(MageSpell::class);
    }

    public function playerClass()
    {
        return $this->belongsTo(PlayerClass::class);
    }

    public function gameObject()
    {
        return $this->belongsTo(GameObject::class, 'game_object_id');
    }

    public function mapObject()
    {
        return $this->belongsTo(MapObject::class, 'map_object_id');
    }
}
