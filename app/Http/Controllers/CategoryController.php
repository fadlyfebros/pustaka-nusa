<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);

        // Menghitung kode kategori baru
        $lastCategory = Category::select('kode_kategori')->orderBy('id', 'desc')->first();
        $newKodeKategori = 'KT' . str_pad(($lastCategory ? intval(substr($lastCategory->kode_kategori, 2)) + 1 : 1), 3, '0', STR_PAD_LEFT);

        return view('admin.pages.categories', compact('categories', 'newKodeKategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $lastCategory = Category::select('kode_kategori')->orderBy('id', 'desc')->first();
        $newKodeKategori = 'KT' . str_pad(($lastCategory ? intval(substr($lastCategory->kode_kategori, 2)) + 1 : 1), 3, '0', STR_PAD_LEFT);

        Category::create([
            'kode_kategori' => $newKodeKategori,
            'name' => $request->name,
        ]);

        return redirect()->route('admin.pages.categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->only('name'));

        return redirect()->route('admin.pages.categories')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.pages.categories')->with('success', 'Kategori berhasil dihapus.');
    }
}
