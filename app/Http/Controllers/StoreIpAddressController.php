<?php

namespace App\Http\Controllers;

use App\Actions\StoreIpAddressAction;
use App\Http\Requests\StoreIpAddressRequest;
use Illuminate\Http\Request;

class StoreIpAddressController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreIpAddressRequest $request)
    {
        $ip = StoreIpAddressAction::run($request->validated());
        
        return response()->json([
            'message' => 'IP has been added successfully',
            'data' => $ip
        ]);
    }
}
