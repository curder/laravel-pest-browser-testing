<?php

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('may user can login', function () {
    Event::fake();

    User::factory()->create([
        'email' => 'example@example.com',
        'password' => 'Passw0rd',
    ]);

    $page = visit('/')->on()->mobile()->inDarkMode();

    $page->click(__('Log in'))
        ->assertSee('Log in to your account')
        ->type('email', 'example@example.com')
        ->type('password', 'Passw0rd')
        ->submit()
        ->assertSee('Dashboard');

    $this->assertAuthenticated();

    Event::assertDispatched(Login::class);
});
