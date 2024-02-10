<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AtmNote;

class AtmNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Atmnote::factory()->create(['note_value' => 20, 'quantity' => 50]);
        AtmNote::factory()->create(['note_value' => 50, 'quantity' => 20]);
    }
}
