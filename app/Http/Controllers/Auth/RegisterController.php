<?php

namespace App\Http\Controllers\Auth;

use App\Actions\StoreUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\AuthUserResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreUserRequest $request)
    {
        $user = StoreUserAction::run($request->validated());

        event(new Registered($user));

        return response()->json(['message' => "Registerd Successfully!"]);
            
    }    
}
