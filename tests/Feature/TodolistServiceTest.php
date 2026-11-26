<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function test_todolist_not_null()
    {
        self::assertNotNull($this->todolistService);
    }
}
