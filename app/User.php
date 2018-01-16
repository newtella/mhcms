<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'username', 'firstname', 'lastname', 'email', 'imageurl', 'password', 'rol_id'
    ];


    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function user()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
