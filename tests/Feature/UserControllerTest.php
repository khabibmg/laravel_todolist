<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_login_page()
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function test_login_page_for_member()
    {
        $this->withSession([
            'user' => 'kurir',
        ])->get('/login')
            ->assertRedirect('/');
    }

    public function test_login_succes()
    {
        $this->post('/login', [
            'user' => 'kurir',
            'password' => 'rahasia',
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'kurir');
    }

    public function test_login_for_user_already_login()
    {
        $this->withSession([
            'user' => 'kurir',
        ])->post('login', [
            'user' => 'kurir',
            'password' => 'rahasia',
        ])->assertRedirect('/');
    }

    public function test_login_validation_error()
    {
        $this->post('/login', [])
            ->assertSeeText('User or Password is required');
    }

    public function test_login_failed()
    {
        $this->post('/login', [
            'user' => 'wrong',
            'password' => 'wrong',
        ])->assertSeeText('User or Password wrong');
    }

    public function test_logout()
    {
        $this->withSession([
            'user' => 'kurir',
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }

    public function test_logout_guest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }
}
