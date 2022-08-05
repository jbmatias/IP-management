<?php

namespace App\Actions;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterAction
{
    use AsAction;

    public function handle(StoreUserRequest $request)
    {
        
    }
}
