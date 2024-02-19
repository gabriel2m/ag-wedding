<?php

namespace App\Console\Commands;

use App\Contracts\Services\UserService;
use App\Rules\UserRules;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateAdminCommand extends Command
{
    use UserRules;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin user using app.admin.email config';

    /**
     * Execute the console command.
     */
    public function handle(UserService $userService)
    {
        try {
            $data = collect([
                'name' => 'Admin',
                'email' => config('app.admin.email'),
                'permissions' => ['admin.*'],
            ]);

            Validator::validate(
                data: $data->only('email')->toArray(),
                rules: $this->userRules()->only('email')->toArray(),
                attributes: ['email' => 'app.admin.email']
            );

            $userService->create($data->toArray());
        } catch (ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    $this->outputComponents()->error($error);
                }
            }

            return 1;
        }

        $this->outputComponents()->info('Admin Created');
    }
}
