@extends('admin.layout')
@section('title', 'Data Buku - Pustaka Nusa')
@section('content')

<div class="p-1">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center">
            <h1 class="mb-0 me-3">Data Buku</h1>
            <p class="mb-0 text-muted">{{ formatTanggal() }}</p>
        </div>
        <div class="text-end">
            <nav aria-label="breadcrumb" class="mb-1">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="/admin" style="text-decoration: none; color: black; display: flex; align-items: center; gap: 5px;">
                            <i class="bi bi-house"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Buku</li>
                </ol>
            </nav>
        </div>
    </div>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahBuku">+ Tambah Buku</button>

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
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
                            <th>Jumlah Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $key => $book)
                            <tr>
                                <td>{{ $books->firstItem() + $key }}</td>
                                <td>{{ $book->judul_buku }}</td>
                                <td>{{ $book->kategori->name ?? 'Kategori tidak ditemukan' }}</td>
                                <td>{{ $book->penerbit->nama_penerbit }}</td>
                                <td>{{ $book->pengarang }}</td>
                                <td>{{ $book->tahun_terbit }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->jumlah_buku }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditBuku" onclick="loadEditData(@json($book))">
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
                                <td colspan="9" class="text-center">No data available in table</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $books->links() }}</div>
</div>

<!-- Modal Tambah Buku -->
<div class="modal fade" id="modalTambahBuku" tabindex="-1" aria-labelledby="modalTambahBukuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.pages.databuku.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBukuLabel">Tambah Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="judul_buku" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" placeholder="Masukkan judul buku" required>
                </div>
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-control" id="kategori_id" name="kategori_id" required>
                        <option value="">-- Pilih Kategori Buku --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="penerbit_id" class="form-label">Penerbit</label>
                    <select class="form-control" id="penerbit_id" name="penerbit_id" required>
                        <option value="">-- Pilih Penerbit Buku --</option>
                        @foreach ($penerbits as $penerbit)
                            <option value="{{ $penerbit->id }}">{{ $penerbit->nama_penerbit }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Masukkan nama pengarang" required>
                </div>
                <div class="mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="Masukkan tahun terbit" min="2000" required>
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Masukkan ISBN buku" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_buku" class="form-label">Jumlah Buku</label>
                    <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" placeholder="Masukkan jumlah buku" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah Buku</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Buku -->
<div class="modal fade" id="modalEditBuku" tabindex="-1" aria-labelledby="modalEditBukuLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" id="formEditBuku" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditBukuLabel">Edit Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="edit_judul_buku" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="edit_judul_buku" name="judul_buku" required>
                </div>
                <div class="mb-3">
                    <label for="edit_kategori_id" class="form-label">Kategori</label>
                    <select class="form-control" id="edit_kategori_id" name="kategori_id" required>
                        <option>-- Pilih Kategori Buku --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edit_penerbit_id" class="form-label">Penerbit</label>
                    <select class="form-control" id="edit_penerbit_id" name="penerbit_id" required>
                        <option>-- Pilih Penerbit Buku --</option>
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
                    <input type="number" class="form-control" id="edit_tahun_terbit" name="tahun_terbit" min="2000" required>
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
        const form = document.getElementById('formEditBuku');
        form.action = `/admin/databuku/${book.id}`;
        document.getElementById('edit_judul_buku').value = book.judul_buku;
        document.getElementById('edit_kategori_id').value = book.kategori_id;
        document.getElementById('edit_penerbit_id').value = book.penerbit_id;
        document.getElementById('edit_pengarang').value = book.pengarang;
        document.getElementById('edit_tahun_terbit').value = book.tahun_terbit;
        document.getElementById('edit_isbn').value = book.isbn;
        document.getElementById('edit_jumlah_buku').value = book.jumlah_buku;
    }
</script>
@endsection
