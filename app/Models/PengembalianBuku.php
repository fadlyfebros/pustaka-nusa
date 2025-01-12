<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianBuku extends Model
{
    use HasFactory;

    protected $table = 'pengembalian_buku';

    protected $fillable = ['user_id', 'book_id', 'tanggal_peminjaman', 'tanggal_pengembalian', 'denda', 'status'];

    public function user()
    {
        return $this->belongsTo(Login::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
