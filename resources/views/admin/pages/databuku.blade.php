@extends('admin.layout')
@section('title', 'Data Buku')
@section('content')

<div class="p-4">
    <h1>Data Buku</h1>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahBuku">+ Tambah Buku</button>

    <div class="card">
        <div class="card-body">
            <table id="tableBuku" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Pengarang</th>
                        <th>Tahun Terbit</th>
                        <th>ISBN</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $key => $book)
                        <tr>
                            <td>{{ $books->firstItem() + $key }}</td>
                            <td>{{ $book->judul_buku }}</td>
                            <td>{{ $book->kategori->name }}</td>
                            <td>{{ $book->penerbit->nama_penerbit }}</td>
                            <td>{{ $book->pengarang }}</td>
                            <td>{{ $book->tahun_terbit }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->jumlah_buku }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditBuku"
                                    onclick="loadEditData({{ $book }})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.pages.databuku.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $books->links() }}</div>
</div>

<!-- Modal Tambah Buku -->
<div class="modal fade" id="modalTambahBuku" tabindex="-1" aria-labelledby="modalTambahBukuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('admin.pages.databuku.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBukuLabel">Tambah Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="judul_buku" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
                </div>
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori_id" name="kategori_id" required>
                        <option value="">-- Harap Pilih Kategori Buku --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="penerbit_id" class="form-label">Penerbit</label>
                    <select class="form-select" id="penerbit_id" name="penerbit_id" required>
                        <option value="">-- Harap Pilih Penerbit Buku --</option>
                        @foreach ($penerbits as $penerbit)
                            <option value="{{ $penerbit->id }}">{{ $penerbit->nama_penerbit }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="pengarang" name="pengarang" required>
                </div>
                <div class="mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" min="2000" required>
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                    <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Buku -->
<div class="modal fade" id="modalEditBuku" tabindex="-1" aria-labelledby="modalEditBukuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editBukuForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditBukuLabel">Edit Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Form Edit Buku -->
                <div class="mb-3">
                    <label for="edit_judul_buku" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="edit_judul_buku" name="judul_buku" required>
                </div>
                <div class="mb-3">
                    <label for="edit_kategori_id" class="form-label">Kategori</label>
                    <select class="form-select" id="edit_kategori_id" name="kategori_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edit_penerbit_id" class="form-label">Penerbit</label>
                    <select class="form-select" id="edit_penerbit_id" name="penerbit_id" required>
                        @foreach ($penerbits as $penerbit)
                            <option value="{{ $penerbit->id }}">{{ $penerbit->nama_penerbit }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edit_pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="edit_pengarang" name="pengarang" required>
                </div>
                <div class="mb-3">
                    <label for="edit_tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="edit_tahun_terbit" name="tahun_terbit" required>
                </div>
                <div class="mb-3">
                    <label for="edit_isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="edit_isbn" name="isbn" required>
                </div>
                <div class="mb-3">
                    <label for="edit_jumlah_buku" class="form-label">Jumlah Buku</label>
                    <input type="number" class="form-control" id="edit_jumlah_buku" name="jumlah_buku" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function loadEditData(book) {
    document.getElementById('edit_judul_buku').value = book.judul_buku;
    document.getElementById('edit_kategori_id').value = book.kategori_id;
    document.getElementById('edit_penerbit_id').value = book.penerbit_id;
    document.getElementById('edit_pengarang').value = book.pengarang;
    document.getElementById('edit_tahun_terbit').value = book.tahun_terbit;
    document.getElementById('edit_isbn').value = book.isbn;
    document.getElementById('edit_jumlah_buku').value = book.jumlah_buku;
    document.getElementById('editBukuForm').action = `/books/${book.id}`;
}
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#tableBuku').DataTable();
    });
</script>
@endsection
