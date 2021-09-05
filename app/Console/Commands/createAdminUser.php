<?php

namespace App\Console\Commands;

use Throwable;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $name_verified = false;
        $surname_verified = false;
        $password_verified = false;
        $email_verified = false;

        while (!$name_verified) {
            $name = $this->ask('What is your name?');

            $validated = $this->validateForInputLength($name);

            if ($validated['success'] ) {
                $name_verified = true;
            } else{
                $this->info($validated['message']);
            }
        }

        while (!$surname_verified) {
            $surname = $this->ask('What is your surname?');

            $validated = $this->validateForInputLength($surname);

            if ($validated['success'] ) {
                $surname_verified = true;
            } else{
                $this->info($validated['message']);
            }
        }

        while(!$password_verified) {
            $password = $this->secret('What is your password?');

            $validated = $this->validateForInputLength($password);

            if ($validated['success'] ) {
                $password_confirmation = $this->secret('Repeat a password.');

                if ($password !== $password_confirmation) {
                    $this->info('Passwords not mach');
                } else {
                    $password_verified = true;
                }
            } else{
                $this->info($validated['message']);
            }
        }

        while(!$email_verified) {
            $email = $this->ask('What is your email?');

            $user = User::where('email', $email)->first();

            if ($user === null) {
                $v = Validator::make(['email' => $email], [
                    'email' => 'email'
                ]);

                if ($v->fails()) {
                    $this->info('Wrong email format');
                } else {
                    $email_verified = true;
                }
            } else {
                $this->info('Email already exists');
            }
        }

        try {
            User::create([
                'name' => $name,
                'surname' => $surname,
                'password' => Hash::make($password.'salt'),
                'email' => $email,
                'is_admin' => true
            ]);

            $this->info('Admin created successfully!');

        } catch (Throwable $exception) {
            $this->info($exception->getMessage());
        }

        return 0;
    }

    public function validateForInputLength(string $value): array
    {
        if (strlen($value) < 4 ) {
            return ['success' => false, 'message' => 'Name is too short (min:4)'];
        } else{
            if (strlen($value) > 50 ) {
                return ['success' => false, 'message' => 'Name is too long (max:50)'];
            } else {
                return ['success' => true, 'message' => 'String length is ok'];
            }
        }
    }
}
