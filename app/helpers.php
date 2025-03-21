<?php

use App\Models\Login;

if (!function_exists('generateKodeUser')) {
    function generateKodeUser()
    {
        $lastUser = Login::select('kode_user')->orderBy('id', 'desc')->first();
        return 'AP' . str_pad(($lastUser ? intval(substr($lastUser->kode_user, 2)) + 1 : 1), 3, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('ucapanWaktu')) {
    function ucapanWaktu()
    {
        $hour = now()->timezone('Asia/Jakarta')->hour;

        if ($hour >= 4 && $hour < 12) {
            return 'Selamat Pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            return 'Selamat Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            return 'Selamat Sore';
        } else {
            return 'Selamat Malam';
        }
    }
}
if (!function_exists('formatTanggal')) {
    function formatTanggal()
    {
        \Carbon\Carbon::setLocale('id');
        return now()->timezone('Asia/Jakarta')->translatedFormat('l, j F Y');
    }
}

if (!function_exists('hitungTanggalPengembalian')) {
    function hitungTanggalPengembalian($tanggalPeminjaman)
    {
        return date('Y-m-d', strtotime($tanggalPeminjaman . ' +14 days'));
    }
}

