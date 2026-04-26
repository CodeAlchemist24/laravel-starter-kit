<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

beforeEach(function (): void {
    $email = config('admin.email');
    $password = config('admin.password') ?? 'secret';

    Artisan::call('laravolt:admin', [
        'name' => 'admin',
        'email' => $email,
        'password' => $password,
    ]);

    $this->adminUser = User::query()->where('email', $email)->firstOrFail();
});

it('can display roles page', function (): void {
    $this->actingAs($this->adminUser);

    $page = visit('/epicentrum/roles');

    $page->assertSee('Roles')
        ->assertNoJavaScriptErrors()
        ->assertScreenshotMatches();
});

it('can display create role page', function (): void {
    $this->actingAs($this->adminUser);

    $page = visit('/epicentrum/roles/create');

    $page->assertNoJavaScriptErrors()
        ->assertScreenshotMatches();
});

it('can display permissions page', function (): void {
    $this->actingAs($this->adminUser);

    $page = visit('/epicentrum/permissions');

    $page->assertSee('Permissions')
        ->assertNoJavaScriptErrors()
        ->assertScreenshotMatches();
});
