<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        $newKodeKategori = 'KT-' . str_pad(Category::max('id') + 1, 3, '0', STR_PAD_LEFT);
        return view('admin.pages.categories', compact('categories', 'newKodeKategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $kodeKategori = 'KT-' . str_pad(Category::max('id') + 1, 3, '0', STR_PAD_LEFT);

        Category::create([
            'kode_kategori' => $kodeKategori,
            'name' => $request->name
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update([ 'name' => $request->name ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
