<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user"=> "kurir"
        ])->get('/login')
            ->assertRedirect("/");
    }

    public function testLoginSucces()
    {
        $this->post('/login', [
            "user" => "kurir",
            "password" => "rahasia"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "kurir");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user"=>"kurir"
        ])->post('login',[
            "user" => "kurir",
            "password"=> "rahasia"
        ])->assertRedirect("/");
    }

    public function testLoginValidationError()
    {
        $this->post("/login",[])
            ->assertSeeText("User or Password is required");
    }

    public function testLoginFailed()
    {
        $this->post('/login',[
            'user' => "wrong",
            'password' => "wrong"
        ])->assertSeeText("User or Password wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "kurir"
        ])->post('/logout')
        ->assertRedirect("/")
        ->assertSessionMissing("user");
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect("/");
    }
}
