<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'xp',
        'level',
        'hp',
        'mp',
        'str',
        'dex',
        'int',
        'class_id',
    ];

    
    
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playerClass()
    {
        return $this->belongsTo(PlayerClass::class, 'class_id');
    }

    public function fights()
    {
        return $this->hasMany(Fight::class);
    }

    public function mageSpells()
    {
        return $this->belongsToMany(MageSpell::class)->withTimestamps();
    }

    public function rounds()
    {
        return $this->hasMany(Round::class, 'attacker_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    // Methods
    
    public function getInventory()
    {
        return $this->items()->get()->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'quantity' => $item->pivot->quantity
            ];
        });
    }

    public function getItemQuantity($item)
    {
        return $this->items()->where('item_id', $item->id)->first()->pivot->quantity ?? 0;
    }

    public function getEquippedWeapon()
    {
        return $this->items()->where('type', 'weapon')->first();
    }
    
    //Combat Methods
    public function getDefence()
    {
        return floor($this->dex / 3) + $this->playerClass->base_defence;
    }

    public function castSpell($mageSpell)
    {
        // Implementation of the castSpell method
        
        $spellPower =  $this->level * $mageSpell->calculateDamage();
        $this->mp -= $mageSpell->mc;
        if ($this->mp < 0) {
            $this->mp = 0;
        }
        $this->save();
        return $spellPower;
    }

    /**
     * Inflict damage on the character.
     *
     * @param int $damage
     * @return void
     */
    public function takeDamage(int $damage)
    {
        $this->hp -= $damage - $this->getDefence();
        if ($this->hp < 0) {
            $this->hp = 0;
        }
        $this->save();
    }

    public function heal($heal)
    {
        $this->hp += $heal;
        
        $this->save();
        return $heal;
    }

    public function attack()
    {
        $attackPower = $this->playerClass->base_attack * rand(1, 5);
        $weapon = $this->getEquippedWeapon();
        //dd($weapon->name);
        $weaponDamage =  $weapon->damage();
        $attackPower += $weaponDamage;
        return $attackPower;
    }

    public function isDead()
    {
        return $this->hp <= 0;
    }

    public function levelUp()
    {
        $this->level++;
        $this->hp += 10; // Increase health points by 10
        $this->mp += 5; // Increase magic points by 5
        $this->str += 2; // Increase strength by 2
        $this->dex += 2; // Increase dexterity by 2
        $this->int += 2; // Increase intelligence by 2
    }

    
}
