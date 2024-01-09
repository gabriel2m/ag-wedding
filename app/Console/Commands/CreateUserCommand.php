<?php

namespace App\Console\Commands;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Console\Command;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\error;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = new CreateNewUser;
        try {
            $action->create([
                'name' => text(label: trans('Name'), required: true),
                'email' => text(label: 'Email', required: true),
                'password' => password(label: trans('Password'), required: true),
                'password_confirmation' => password(label: trans('Confirm Password'), required: true),
            ]);
        } catch (ValidationException $e) {
            foreach ($e->errors() as $attr => $errors) {
                foreach ($errors as $error) {
                    error("$attr: $error");
                }
            }

            return 1;
        }
        outro(trans('Created.'));
    }
}
