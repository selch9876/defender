<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to refresh the database?')) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database have been refreshed!');
        }
        // \App\Models\User::factory(10)->create();
        $this->call([
            UsersTableSeeder::class,
            PlayerClassSeeder::class,
            MageSpellSeeder::class,
        ]);
    }
}
