<?php

if (!function_exists('generateItem')) {
    function generateItem($level) {
        // Determine the item type
        $types = ['weapon', 'armor', 'consumable'];
        $type = $types[array_rand($types)];
    
        // Determine the item rarity based on the player's level
        $rarities = ['common', 'uncommon', 'rare', 'epic', 'legendary'];
        $minRarity = max(0, floor(($level - 1) / 10) - 1);
        $maxRarity = min(4, $minRarity + 1);
        $rarity = $rarities[rand($minRarity, $maxRarity)];
    
        // Generate the item based on its type and rarity
        $item = [];
    
        switch ($type) {
            case 'weapon':
                $weaponTypes = ['sword', 'axe', 'mace'];
                $weaponType = $weaponTypes[array_rand($weaponTypes)];
                $item = [
                    'type' => 'weapon',
                    'name' => ucfirst($weaponType) . ' of ' . ucfirst($rarity),
                    'damage' => rand($level * 2, $level * 4),
                    'attackSpeed' => rand(1, 3),
                    'rarity' => $rarity,
                ];
                break;
            case 'armor':
                $armorTypes = ['helmet', 'chestplate', 'leggings', 'boots'];
                $armorType = $armorTypes[array_rand($armorTypes)];
                $item = [
                    'type' => 'armor',
                    'name' => ucfirst($armorType) . ' of ' . ucfirst($rarity),
                    'armor' => rand($level * 2, $level * 4),
                    'rarity' => $rarity,
                ];
                break;
            case 'consumable':
                $consumableTypes = ['potion', 'food'];
                $consumableType = $consumableTypes[array_rand($consumableTypes)];
                $item = [
                    'type' => 'consumable',
                    'name' => ucfirst($consumableType) . ' of ' . ucfirst($rarity),
                    'effect' => $consumableType == 'potion' ? 'healing' : 'hunger',
                    'amount' => rand(1, 5),
                    'rarity' => $rarity,
                ];
                break;
        }
    
        return $item;
    }
    
}
