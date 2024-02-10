<?php

namespace Tests\Feature;

use App\Models\AtmNote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAvailableNotesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test retrieving available notes from the ATM.
     *
     * @return void
     */
    public function testGetAvailableNotes()
    {
        // Initialize ATM notes in the database
        AtmNote::factory()->create(['note_value' => 20, 'quantity' => 100]);
        AtmNote::factory()->create(['note_value' => 50, 'quantity' => 100]);

        // Call the API endpoint to retrieve available notes
        $response = $this->getJson('/api/available-notes');

        // Assert that the response is successful (HTTP status code 200)
        $response->assertOk();

        // Assert that the response contains the expected note values and quantities
        $response->assertJsonFragment(['note_value' => 20, 'quantity' => 100]);
        $response->assertJsonFragment(['note_value' => 50, 'quantity' => 100]);
        // Add more assertions if necessary
    }
}
