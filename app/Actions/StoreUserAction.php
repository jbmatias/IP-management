<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreUserAction
{
    use AsAction;

    public function handle(array $input): User
    {
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
