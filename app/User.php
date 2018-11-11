<?php

namespace U;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'city', 'admin', 'hobby'
    ];

    protected $casts = [
        'hobby' => 'array'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function isAdmin()
    {
        if ($this->admin)
            return true;

        return false;
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value))
            $this->attributes['password'] = Hash::make($value);
    }

    public function setApiTokenAttribute($value){
        if(empty($value))
           $this->attributes['api_token'] = Str::random(60);
    }
}
