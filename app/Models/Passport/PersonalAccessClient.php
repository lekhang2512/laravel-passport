<?php

namespace App\Models\Passport;

use Laravel\Passport\PersonalAccessClient as PassportPersonalAccessClient;

class PersonalAccessClient extends PassportPersonalAccessClient
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'woo_fb_pixel_oauth_personal_access_clients';
}
