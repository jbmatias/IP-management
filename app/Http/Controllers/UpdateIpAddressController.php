<?php

namespace App\Http\Controllers;

use App\Actions\UpdateIpAddressAction;
use App\Http\Requests\UpdateIpAddressRequest;
use App\Models\IpAddress;
use Illuminate\Http\Request;

class UpdateIpAddressController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateIpAddressRequest $request, IpAddress $address)
    {
        $address = UpdateIpAddressAction::run($address, $request->validated());
        return response()->json([
            "message" => "Update successful!",
            "address" => $address
        ]);
    }
}
