<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     *
     * @test
     */
    public function canVisitLoginPage()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');

    }

    /**
     *
     * @test
     */
    public function canLogin()
    {
        $data = [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ];
        $response = $this->post('/login', $data);
        $response->assertStatus(302);
        $response->assertLocation('/admin/home');
        $this->assertAuthenticatedAs($this->admin);

    }

    /**
     *
     * @test
     */
    public function canUnAuthorisedUserAccessDashboard()
    {
        $this->withExceptionHandling();
        $response =  $this->get('/admin/home');;
        $response->assertStatus(302);
        $response->assertLocation('/login');
    }


    /**
     *
     * @test
     */
    public function cannotRegister()
    {
        $this->withExceptionHandling();
        $response =  $this->get('/register');;
        $response->assertStatus(404);
    }


}
