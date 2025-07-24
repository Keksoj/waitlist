<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nameslug = $this->ask('Enter the nameslug of the account to delete');

        $user = User::where('nameslug', $nameslug)->first();

        if ($this->confirm("Found user {$user->name}, are you sure you want to delete them?")) {
            if ($this->confirm("ARE YOU A 100% SURE? All subscriptions and notes of this user will be deleted")) {
                $user->delete();

                $this->info("Deleted user {$user->name} and all associated data");
                return 0;
            }
        }

        $this->info("No user was deleted");
        return 0;
    }
}
