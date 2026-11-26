<?php

namespace Tests\Feature;

use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function test_sample()
    {
        self::assertTrue(true);
    }

    public function test_login_succes()
    {
        self::assertTrue($this->userService->login('kurir', 'rahasia'));
    }

    public function test_login_user_not_found()
    {
        self::assertFalse($this->userService->login('gethok', 'gethok'));
    }

    public function test_login_wrong_password()
    {
        self::assertFalse($this->userService->login('kurir', 'salah'));
    }
}
