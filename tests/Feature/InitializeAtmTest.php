<?php

namespace Tests\Feature;

use App\Models\AtmNote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InitializeAtmTest extends TestCase
{

        use RefreshDatabase;

    /**
     * Test initializing the ATM.
     *
     * @return void
     */
    public function testInitializeAtm()
    {
        // Call the API endpoint to initialize the ATM
        $response = $this->postJson('/api/initialize',  ['note_value' => 50, 'quantity' => 100]);

        // Assert that the response is successful (HTTP status code 200)
        $response->assertOk();

        // Get all distinct note values from the database
        $distinctNoteValues = AtmNote::pluck('note_value')->unique();

        // Assert that there is at least one note for each distinct note value
        foreach ($distinctNoteValues as $noteValue) {
            $this->assertDatabaseHas('atm_notes', ['note_value' => $noteValue]);
        }
    }
}

