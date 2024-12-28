@extends('admin.layout')
@section('title', 'Data Buku')
@section('content')

<div class="p-4">
    <h1>Data Buku</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahBuku">+ Tambah Buku</button>

    <div class="card">
        <div class="card-body">
            <table id="tableBooks" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Pengarang</th>
                        <th>Tahun Terbit</th>
                        <th>ISBN</th>
                        <th>Jumlah Baik</th>
                        <th>Jumlah Rusak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $key => $book)
                        <tr>
                            <td>{{ $books->firstItem() + $key }}</td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->kategori->nama }}</td>
                            <td>{{ $book->penerbit->nama }}</td>
                            <td>{{ $book->pengarang }}</td>
                            <td>{{ $book->tahun_terbit }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->jumlah_baik }}</td>
                            <td>{{ $book->jumlah_rusak }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditBuku" onclick="loadEditData(@json($book))">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $books->links() }}</div>
</div>

<!-- Modal Tambah Buku -->
<div class="modal fade" id="modalTambahBuku" tabindex="-1" aria-labelledby="modalTambahBukuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('books.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBukuLabel">Tambah Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-control" id="kategori_id" name="kategori_id" required>
                        <option> -- Harap pilih kategori buku -- </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="penerbit_id" class="form-label">Penerbit</label>
                    <select class="form-control" id="penerbit_id" name="penerbit_id" required>
                        <option>-- Harap Pilih Penerbit Buku --</option>
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
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" required>
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_baik" class="form-label">Jumlah Baik</label>
                    <input type="number" class="form-control" id="jumlah_baik" name="jumlah_baik" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_rusak" class="form-label">Jumlah Rusak</label>
                    <input type="number" class="form-control" id="jumlah_rusak" name="jumlah_rusak" required>
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
                <!-- Mirip dengan modal tambah -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#tableBooks').DataTable();
});
function loadEditData(book) {
    // Assign the form's action URL dynamically
    const form = document.getElementById('editBukuForm');
    form.action = `/books/${book.id}`;

    // Set values to the inputs in the edit modal
    document.getElementById('editJudul').value = book.judul;
    document.getElementById('editKategoriId').value = book.kategori_id;
    document.getElementById('editPenerbitId').value = book.penerbit_id;
    document.getElementById('editPengarang').value = book.pengarang;
    document.getElementById('editTahunTerbit').value = book.tahun_terbit;
    document.getElementById('editIsbn').value = book.isbn;
    document.getElementById('editJumlahBaik').value = book.jumlah_baik;
    document.getElementById('editJumlahRusak').value = book.jumlah_rusak;
}
</script>

@endsection
