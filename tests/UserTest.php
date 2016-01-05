<?php

use App\User;

class UserTest extends TestCase
{
    /**
     * Test that the getAvatarUrl function returns the correct Gravatar URL for a specific email.
     */
    public function testGeneratedGravatarUrlIsCorrect()
    {
        $user = new User();
        $user->email = 'me@mitchfizz05.net';

        $this->assertEquals(
            '//www.gravatar.com/avatar/4083e548052988dbd2b4c47e39efa7ce?s=150&d=monsterid',
            $user->getAvatarUrl(150)
        );
    }
}