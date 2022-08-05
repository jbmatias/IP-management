<?php

namespace App\Http\Controllers;

use App\Actions\IndexIpAddressAction;
use App\Http\Requests\IndexIpAddressRequest;
use Illuminate\Http\Request;

class IndexIpAddressController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(IndexIpAddressRequest $request)
    {        
        $data = IndexIpAddressAction::run();
        
        return response()->json([
            "message" => "List of the Ip Addresses",
            "data" => $data
        ]);
    }
}
