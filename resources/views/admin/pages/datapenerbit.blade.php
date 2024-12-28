@extends('admin.layout')
@section('title', 'Data Penerbit')
@section('content')
<div class="p-4">
    <h1 class="mb-3">Data Penerbit</h1>

    <!-- Button Tambah Penerbit -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPenerbit">+ Tambah Penerbit</button>

    <div class="card">
        <div class="card-body">
            <table id="tablePenerbit" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Penerbit</th>
                        <th>Nama Penerbit</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penerbit as $key => $item)
                        <tr>
                            <td>{{ $penerbit->firstItem() + $key }}</td>
                            <td>{{ $item->kode_penerbit }}</td>
                            <td>{{ $item->nama_penerbit }}</td>
                            <td>
                                @if($item->status == 'Terverifikasi')
                                    <span class="badge bg-success">Penerbit Terverifikasi</span>
                                @else
                                    <span class="badge bg-danger">Penerbit Belum Terverifikasi</span>
                                @endif
                            </td>
                            <td>
                                <!-- Button Edit Penerbit -->
                                <button class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditPenerbit"
                                        onclick="loadEditData({{ $item }})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <!-- Hapus Penerbit -->
                                <form action="{{ route('datapenerbit.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus penerbit ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data penerbit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>
        {{ $penerbit->links() }}
    </div>
</div>

<!-- Modal Tambah Penerbit -->
<div class="modal fade" id="modalTambahPenerbit" tabindex="-1" aria-labelledby="modalTambahPenerbitLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPenerbitLabel">Tambah Penerbit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('datapenerbit.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_penerbit" class="form-label">Kode Penerbit</label>
                        <input type="text" class="form-control" id="kode_penerbit" name="kode_penerbit" value="{{ $newKodePenerbit }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_penerbit" class="form-label">Nama Penerbit</label>
                        <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Terverifikasi">Terverifikasi</option>
                            <option value="Belum Terverifikasi">Belum Terverifikasi</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Penerbit -->
<div class="modal fade" id="modalEditPenerbit" tabindex="-1" aria-labelledby="modalEditPenerbitLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPenerbitLabel">Edit Penerbit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPenerbitForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_kode_penerbit" class="form-label">Kode Penerbit</label>
                        <input type="text" class="form-control" id="edit_kode_penerbit" name="kode_penerbit" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nama_penerbit" class="form-label">Nama Penerbit</label>
                        <input type="text" class="form-control" id="edit_nama_penerbit" name="nama_penerbit" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="Terverifikasi">Terverifikasi</option>
                            <option value="Belum Terverifikasi">Belum Terverifikasi</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script>
function loadEditData(item) {
    document.getElementById('edit_kode_penerbit').value = item.kode_penerbit;
    document.getElementById('edit_nama_penerbit').value = item.nama_penerbit;
    document.getElementById('edit_status').value = item.status;
    document.getElementById('editPenerbitForm').action = `/admin/penerbit/${item.id}`;
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#tablePenerbit').DataTable();
    });
</script>
