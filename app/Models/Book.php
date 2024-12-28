<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'kategori_id', 'penerbit_id', 'pengarang', 'tahun_terbit', 'isbn', 'jumlah_baik', 'jumlah_rusak'
    ];

    // App\Models\Book.php
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }
}
