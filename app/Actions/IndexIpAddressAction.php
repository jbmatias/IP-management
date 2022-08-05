<?php

namespace App\Actions;

use App\Http\Resources\IpAddressCollection;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class IndexIpAddressAction
{
    use AsAction;

    public function handle()
    {        
        return new IpAddressCollection(Auth()->user()->ipAddresses);
    }
}
