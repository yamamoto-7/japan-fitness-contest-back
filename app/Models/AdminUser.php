<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AdminUser extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'admin_users'; // テーブル名に合わせて

    protected $fillable = [
        'login_id',
        'name',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // JWTSubject 実装
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
