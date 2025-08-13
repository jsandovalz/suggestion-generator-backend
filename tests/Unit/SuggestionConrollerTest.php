<?php

namespace Tests\Unit;

use Tests\TestCase;

class SuggestionConrollerTest extends TestCase
{
    /**
     * Verify that the API returns the correct suggestions for “local election.”
     *
     * @return void
     */
    public function test_returns_suggestions_for_local_election()
    {
        $response = $this->postJson('/api/suggestions', [
            'prompt' => 'local election'
        ]);

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }
/**
     * Verify that the API returns the correct suggestions for “sports news.”.
     *
     * @return void
     */
    public function test_returns_suggestions_for_sports_news()
    {
        $response = $this->postJson('/api/suggestions', [
            'prompt' => 'sports news'
        ]);

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }

    /**
     * Verify that the API returns the correct suggestions for any prompt
     *
     * @return void
     */
    public function test_returns_default_message_for_unknown_prompt()
    {
        $prompt = 'unknown topic';
        $response = $this->postJson('/api/suggestions', [
            'prompt' => $prompt
        ]);

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }
    
}
