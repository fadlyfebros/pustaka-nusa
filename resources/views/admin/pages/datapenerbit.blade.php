@extends('admin.layout')

@section('title', 'Data Penerbit')

@section('content')
<div class="container">
    <h1 class="mt-4">Data Penerbit</h1>
    <div class="card my-4">
        <div class="card-header">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPenerbitModal">Tambah Penerbit</button>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table id="tablePenerbit" class="table table-bordered table-striped">
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
                    @foreach($penerbit as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->kode_penerbit }}</td>
                            <td>{{ $item->nama_penerbit }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPenerbitModal" onclick="loadEditData({{ $item->id }})">Edit</button>
                                <form action="{{ route('datapenerbit.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus penerbit ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $penerbit->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Penerbit -->
<div class="modal fade" id="addPenerbitModal" tabindex="-1" aria-labelledby="addPenerbitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('datapenerbit.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPenerbitModalLabel">Tambah Penerbit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Penerbit -->
<div class="modal fade" id="editPenerbitModal" tabindex="-1" aria-labelledby="editPenerbitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editPenerbitForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPenerbitModalLabel">Edit Penerbit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
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
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function loadEditData(id) {
        fetch(`/admin/datapenerbit/${id}/edit`) // URL yang sesuai
            .then(response => {
                if (!response.ok) {
                    throw new Error('Penerbit tidak ditemukan');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('edit_kode_penerbit').value = data.kode_penerbit;
                document.getElementById('edit_nama_penerbit').value = data.nama_penerbit;
                document.getElementById('edit_status').value = data.status;
                document.getElementById('editPenerbitForm').action = `/admin/datapenerbit/${id}`;
            })
            .catch(error => console.error('Error:', error));
    }
document.addEventListener('DOMContentLoaded', function () {
    $('#tablePenerbit').DataTable();
});
</script>
@endsection
