<?php

namespace App\Models\Passport;

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'woo_fb_pixel_oauth_clients';
}
