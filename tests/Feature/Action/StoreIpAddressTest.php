<?php

use App\Actions\StoreIpAddressAction;
use App\Models\IpAddress;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

test('Store Ip address with label', function () {
    //given
    $user = User::factory()->create();    
    $attributes = IpAddress::factory()->raw([
        'user_id' => $user->id
    ]);        
    
    $response = $this->actingAs($user, 'api')->post(route('ip.store'), $attributes);            
    $response->assertStatus(200);    
});
