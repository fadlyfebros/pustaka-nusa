@extends('admin.layout')
@section('title', 'Kategori Buku')
@section('content')

<div class="p-4">
    <h1>Kategori Buku</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">+ Tambah Kategori</button>

    <div class="card">
        <div class="card-body">
            <table id="tableCategory" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $key }}</td>
                            <td>{{ $category->kode_kategori }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditKategori" onclick="loadEditData(@json($category))">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
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

    <div class="mt-3">{{ $categories->links() }}</div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('categories.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahKategoriLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="kode_kategori" class="form-label">Kode Kategori</label>
                    <input type="text" class="form-control" id="kode_kategori" name="kode_kategori" value="{{ $newKodeKategori }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="modalEditKategori" tabindex="-1" aria-labelledby="modalEditKategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editKategoriForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditKategoriLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="edit_kode_kategori" class="form-label">Kode Kategori</label>
                    <input type="text" class="form-control" id="edit_kode_kategori" name="kode_kategori" value="{{ $newKodeKategori }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="edit_name" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="edit_name" name="name" value="" required>
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
function loadEditData(category) {
    document.getElementById('edit_name').value = category.name;
    document.getElementById('edit_kode_kategori').value = category.kode_kategori;
    document.getElementById('editKategoriForm').action = `/categories/${category.id}`;
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#tableCategory').DataTable();
    });
</script>
@endsection
