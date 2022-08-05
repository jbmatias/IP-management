<?php


use App\Actions\StoreIpAddressAction;
use App\Models\IpAddress;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);


test('Update Ip address label', function () {
    
    $user = User::factory()->create(); 
    $address = IpAddress::factory()->create([
        'user_id' => $user->id
    ]);
    $attributes = IpAddress::factory()->raw([
        'user_id' => $user->id
    ]); 

    $response = $this->actingAs($user, 'api')->put(route('ip.update', $address), $attributes); 

    $response->assertStatus(200);
});
