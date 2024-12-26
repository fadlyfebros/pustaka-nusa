<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    use HasFactory;

    protected $table = 'login'; // Nama tabel
    protected $primaryKey = 'id_user'; // Primary key

    protected $fillable = [
        'kode_user',
        'fullname',
        'username',
        'email',
        'password',
        'kelas',
        'alamat',
        'verif',
        'role',
        'join_date',
        'terakhir_login',
    ];

    protected $hidden = [
        'password',
    ];
}
