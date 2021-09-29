<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\MustVerifyEmail;
use App\Repositories\Users\FilterTrait;
use App\Repositories\Users\PresentationTrait;
use Darkness\Repository\Entity;

use Laravel\Passport\HasApiTokens;

class User extends Entity implements AuthorizableContract, AuthenticatableContract, CanResetPasswordContract
{
    use HasApiTokens, Notifiable;
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    use FilterTrait, PresentationTrait;

    protected $table = 'woo_fb_pixel_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
