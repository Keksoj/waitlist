<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Full name');

        $defaultSlug = Str::slug($name);

        $nameslug = $this->ask("Nameslug, press enter for default value =>", $defaultSlug);

        $this->info("slug is {$nameslug}");
        $email = $this->ask('Email (obligatory)');

        $password = $this->secret('Password (will default to "password" if left blank)');
        if (empty($password)) {
            $password = 'password';
        }

        $hashedPassword = Hash::make($password);

        $user = User::create([
            'name' => $name,
            'nameslug' => $nameslug,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        $this->info("✅ User '{$user->name}' created successfully!");
        $this->line("→ ID: {$user->id}");
        $this->line("→ Slug: {$user->nameslug}");
        $this->line("→ Email: " . ($user->email ?? '—'));
        $this->line("→ Password: (hidden — but you set it)");

        return 0;
    }
}
