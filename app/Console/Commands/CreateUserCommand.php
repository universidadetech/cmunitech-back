<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create {email} {password} {name?}';
    protected $description = 'Create a new user';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->argument('name') ?? 'Default Name';

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("User {$user->email} created successfully.");

        // Opcional: Gerar token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;
        $this->info("Token: {$token}");
    }
}
