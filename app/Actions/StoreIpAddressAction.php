<?php

namespace App\Actions;

use App\Models\IpAddress;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreIpAddressAction
{
    use AsAction;

    public function handle(array $input): IpAddress
    {
        return auth()->user()->ipAddresses()->create($input);
    }
}
