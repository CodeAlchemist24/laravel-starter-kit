<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $name = config('admin.username');
        $email = config('admin.email');
        $password = config('admin.password');

        if (! $password) {
            $password = Str::password(16);
            $this->command->info('Default admin password: '.$password);
        }

        Artisan::call('laravolt:admin', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }
}
