<?php

namespace App\Models\Passport;

use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'woo_fb_pixel_oauth_access_tokens';
}
