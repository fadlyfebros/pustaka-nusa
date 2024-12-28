<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    use HasFactory;

    protected $table = 'login';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'kode_user',
        'fullname',
        'username',
        'password',
        'role',
        'email',
        'kelas',
        'alamat',
        'verif',
        'join_date',
        'terakhir_login',
    ];

    protected $hidden = ['password'];
}
