<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\assertTrue;

it('user can generate gravatar default image when no email found first', function ($data) {
    $user = User::factory()->create([
        'name' => 'Andre',
        'email' => $data['email'],
    ]);

    $response = Http::get($user->getAvatar());
    assertTrue($response->successful());
})->with([
    'character a' => [['email' => 'afakeemail@fakeemail.com']],
    'character z' => [['email' => 'zfakeemail@fakeemail.com']],
    'character 0' => [['email' => '0fakeemail@fakeemail.com']],
    'character 9' => [['email' => '9fakeemail@fakeemail.com']]
]);
