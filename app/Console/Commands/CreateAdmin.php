<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin user';

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
     * @return mixed
     */
    public function handle()
    {
        $data = $this->arguments();

        $validationResult = $this->validator($data);
        if($validationResult->fails())
        {
            echo 'Validation error: ' . PHP_EOL ;
            foreach ($validationResult->getMessageBag()->getMessages() as $key => $value) {
                echo $key . ': ' . $value[0] . PHP_EOL;
            }
            return;
        }

        $admin = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $admin->save();
        $admin->roles()->attach(Role::where('name', 'ADMIN')->get());
        $admin->save();

        echo 'Admin created successfully' . PHP_EOL;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }
}
