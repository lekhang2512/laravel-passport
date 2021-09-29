<?php

namespace App\Models\Passport;

use Laravel\Passport\RefreshToken as PassportRefreshToken;

class RefreshToken extends PassportRefreshToken
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'woo_fb_pixel_oauth_refresh_tokens';
}
