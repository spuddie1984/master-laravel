<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageIsWorking()
    {
        // Act
        $response = $this->get('/');

        // Assert
        $response->assertSeeText('Welcome to the Home Page');
    }
}
