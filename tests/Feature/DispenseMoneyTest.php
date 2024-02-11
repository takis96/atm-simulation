<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\AtmNote;

class DispenseMoneyTest extends TestCase
{
    use RefreshDatabase;


    public function it_dispenses_money_correctly()
    {
        // Initialize ATM notes in the database
        AtmNote::factory()->create(['note_value' => 20, 'quantity' => 100]);
        AtmNote::factory()->create(['note_value' => 50, 'quantity' => 100]);

        // Call the API endpoint to dispense money asked for
        $response1 = $this->postJson('/api/dispense-money', ['amount' => 150]);
        $response2 = $this->postJson('/api/dispense-money', ['amount' => 70]);

        $response1->assertStatus(200)
            ->assertJson(['message' => 'Money dispensed successfully']);
        $response2->assertStatus(200)
            ->assertJson(['message' => 'Money dispensed successfully']);

        // Assert ATM note quantities
        $this->assertEquals(96, AtmNote::where('note_value', 50)->first()->quantity);
        $this->assertEquals(99, AtmNote::where('note_value', 20)->first()->quantity);
    }
}
