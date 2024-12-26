<?php

use App\Models\Login;

if (!function_exists('generateKodeUser')) {
    function generateKodeUser()
    {
        $lastUser = Login::select('kode_user')->orderBy('id_user', 'desc')->first();
        return 'AP' . str_pad(($lastUser ? intval(substr($lastUser->kode_user, 2)) + 1 : 1), 3, '0', STR_PAD_LEFT);
    }
}
