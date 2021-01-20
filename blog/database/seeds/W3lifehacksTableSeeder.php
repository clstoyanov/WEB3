<?php

use Illuminate\Database\Seeder;

class W3lifehacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('w3lifehacks')->insert([
            'name' => 'Breathe',
            'description' => 'Inhale and exhale to breathe easily :)',
            'user' => 'Admin'
        ]);

        DB::table('w3lifehacks')->insert([
            'name' => 'Walk',
            'description' => 'Put one foot infront of the other to walk easily :)',
            'user' => 'Admin'
        ]);

        DB::table('w3lifehacks')->insert([
            'name' => 'Blink',
            'description' => 'Close eyes very quickly to blink easily :)',
            'user' => 'Admin'
        ]);

        DB::table('w3lifehacks')->insert([
            'name' => 'High Five',
            'description' => "Slap someone's open hand to high five them easily :)",
            'user' => 'Admin'
        ]);
    }
}
