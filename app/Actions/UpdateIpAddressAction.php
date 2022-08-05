<?php

namespace App\Actions;

use App\Models\IpAddress;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateIpAddressAction
{
    use AsAction;

    public function handle(IpAddress $address, array $attributes)
    {
        return $address->update($attributes);
    }
}
