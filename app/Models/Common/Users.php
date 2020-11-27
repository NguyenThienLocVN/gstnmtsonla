<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    public $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'username', 'password', 'phone', 'organization'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public $timestamps = false;
    protected $rememberTokenName = false;
    function getAuthPassWord()
    {
        return $this->password;
    }
}