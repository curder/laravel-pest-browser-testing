<?php

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('may user can register', function () {
    Event::fake();

    $page = visit('/')->on()->mobile();

    $page->click(__('Register'))
        ->assertSee(__('Create an account'))
        ->assertSee(__('Log in'))
        ->type('name', 'Example')
        ->type('email', 'example@example.com')
        ->type('password', 'Passw0rd')
        ->type('password_confirmation', 'Passw0rd')
        ->submit()
        ->assertSee('Dashboard');

    $this->assertAuthenticated();

    Event::assertDispatched(Registered::class);
});
