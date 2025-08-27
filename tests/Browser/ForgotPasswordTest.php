<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('may reset the password', function () {
    Notification::fake();

    User::factory()->create(['email' => 'example@example.com']);

    $page = visit('/forgot-password');

    $page->type('email', 'example@example.com')
        ->press('Email password reset link')
        ->assertSee('A reset link will be sent if the account exists.')
//        ->assertNoConsoleLogs()
        ->assertNoJavascriptErrors();

    Notification::assertSentTimes(ResetPassword::class, 1);
});
