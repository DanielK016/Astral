<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_menu_page_loads(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
