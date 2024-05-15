<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class AuthHelper
{
    /**
     * Generate a random bcrypted password.
     */
    public function generateRandomPassword()
    {
        // Generate an 8-character random word
        $randomPassword = Str::random(8);

        // Hash the random password and return it
        return bcrypt($randomPassword);
    }
}
