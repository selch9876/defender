<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterManager extends Model
{
    use HasFactory;

    private $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function setClass($classId)
    {
        $this->character->class_id = $classId;
        $this->character->save();
    }

    public function getClass()
    {
        return $this->character->playerClass;
    }

    public function defeatEnemy(Enemy $enemy)
    {
        $xp = $enemy->getXpReward();

        // Add the XP to the character's XP property
        $this->character->setXp($this->character->getXp() + $xp);

        // Level up the character if they have enough XP
        $this->character->levelUp();

        // Add any other logic to handle the character's reward for defeating this enemy
    }

    public function completeQuest(Quest $quest)
    {
        $xp = $quest->getXpReward();

        // Add the XP to the character's XP property
        $this->character->setXp($this->character->getXp() + $xp);

        // Level up the character if they have enough XP
        $this->character->levelUp();

        // Add any other logic to handle the character's reward for completing this quest
    }
}
