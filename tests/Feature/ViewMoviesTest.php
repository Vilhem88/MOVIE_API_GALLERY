<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_main_page_show_correct_info(): void
    {
        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('NOW PLAYING');
    }
}
