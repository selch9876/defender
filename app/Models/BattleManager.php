<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattleManager extends Model
{
    use HasFactory;

    private $character;
    private $enemy;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function setEnemy($enemyId)
    {
        $this->enemy = Enemy::find($enemyId);
    }

    public function getEnemy()
    {
        return $this->enemy;
    }

    // Add any other methods or logic you need to handle enemies

    public function startBattle(Character $character, Enemy $enemy)
    {
        $battleLog = new BattleLog([
            'character_id' => $character->id,
            'enemy_id' => $enemy->id,
            'experience_gained' => 0,
            'gold_gained' => 0,
            'start_time' => now(), // set the start time
        ]);
        $battleLog->save();

        // start the battle logic

        $battleLog->end_time = now(); // set the end time
        $battleLog->save();

        return redirect()->route('battle.result', ['battleLog' => $battleLog]);
    }

    public function doBattle(Character $character, Enemy $enemy)
    {
        $characterHP = $character->max_hp;
        $enemyHP = $enemy->max_hp;

        while ($characterHP > 0 && $enemyHP > 0) {
            // Player character turn
            $characterDamage = rand($character->min_damage, $character->max_damage);
            $enemyHP -= $characterDamage;

            // Enemy turn
            $enemyDamage = rand($enemy->min_damage, $enemy->max_damage);
            $characterHP -= $enemyDamage;
        }

        // Determine the winner and calculate rewards
        if ($characterHP > 0) {
            $experienceGained = $enemy->experience_given;
            $goldGained = $enemy->gold_given;
            $character->gainExperience($experienceGained);
            $character->gainGold($goldGained);
            $result = 'victory';
        } else {
            $experienceGained = 0;
            $goldGained = 0;
            $result = 'defeat';
        }

        // Log the battle
        $battleLog = new BattleLog([
            'character_id' => $character->id,
            'enemy_id' => $enemy->id,
            'experience_gained' => $experienceGained,
            'gold_gained' => $goldGained,
            'start_time' => now(),
            'end_time' => now(),
        ]);
        $battleLog->save();

        return $result;
    }

}
