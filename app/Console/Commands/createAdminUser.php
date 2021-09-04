<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class createAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evis:create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user with admin role';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $name = $this->ask('What is your name?');
        $surname = $this->ask('What is your surname?');
        $password = $this->secret('What is your password?');
        $password_confirmation = $this->secret('Repeat a password.');
        $email = $this->ask('What is your email?');

        $v = Validator::make([
            'name' => $name,
            'surname' => $surname,
            'password' => $password,
            'password_confirmation' => $password_confirmation,
            'email' => $email
        ], [
            'name' => 'required|max:50',
            'surname' => 'required|max:50',
            'password' => [
                'required',
                'confirmed',
                Password::min(4)
            ],
            'email' => 'required|unique:users|email'
        ]);

        if ($v->fails())
        {
            $this->info($v->errors()->first());
        } else {
            User::create([
                'name' => $name,
                'surname' => $surname,
                'password' => Hash::make($password.'salt'),
                'email' => $email,
                'is_admin' => true
            ]);

            $this->info('Admin created successfully!');
        }

        return 0;
    }
}
