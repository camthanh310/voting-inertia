<?php

use App\Models\User;

use function PHPUnit\Framework\assertEquals;

test('user can generate gravatar default image when no email found first', function ($data) {
    $user = User::factory()->create([
        'name' => 'Andre',
        'email' => $data['email'],
    ]);

    $gravatarUrl = $user->getAvatar();

    assertEquals(
        'https://www.gravatar.com/avatar/' . md5($user->email) . '?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/' . $data['default_avatar'],
        $gravatarUrl
    );
})->with([
    'character a' => [['email' => 'afakeemail@fakeemail.com', 'default_avatar' => 'default-avatar-1.png']],
    'character z' => [['email' => 'zfakeemail@fakeemail.com', 'default_avatar' => 'default-avatar-26.png']],
    'character 0' => [['email' => '0fakeemail@fakeemail.com', 'default_avatar' => 'default-avatar-27.png']],
    'character 9' => [['email' => '9fakeemail@fakeemail.com', 'default_avatar' => 'default-avatar-36.png']]
]);
