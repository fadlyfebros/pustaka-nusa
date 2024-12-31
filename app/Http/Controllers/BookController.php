<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('kategori', 'penerbit')->paginate(10);
        $categories = Category::all();
        $penerbits = Penerbit::all();

        return view('admin.pages.books', compact('books', 'categories', 'penerbits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'penerbit_id' => 'required|exists:penerbits,id',
            'pengarang' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required|string|max:13',
            'jumlah_buku' => 'required|integer|min:0',
        ]);

        Book::create($request->all());

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan.');
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'penerbit_id' => 'required|exists:penerbits,id',
            'pengarang' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required|string|max:13',
            'jumlah_buku' => 'required|integer|min:0',
        ]);

        $book->update($request->all());

        return redirect()->back()->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus.');
    }
}
