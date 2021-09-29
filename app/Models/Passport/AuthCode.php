<?php

namespace App\Models\Passport;

use Laravel\Passport\AuthCode as PassportAuthCode;

class AuthCode extends PassportAuthCode
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'woo_fb_pixel_oauth_auth_codes';
}
