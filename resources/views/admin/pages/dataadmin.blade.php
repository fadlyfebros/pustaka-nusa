@extends('admin.layout')
@section('title', 'Data Admin')
@section('content')

<div class="p-4">
    <h1>Data Admin</h1>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">+ Tambah Admin</button>

    <div class="card">
        <div class="card-body">
            <table id="tableAdmin" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Pengguna</th>
                        <th>Terakhir Login</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $key => $admin)
                        <tr>
                            <td>{{ $admins->firstItem() + $key }}</td>
                            <td>{{ $admin->fullname }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>{{ $admin->updated_at }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditAdmin"
                                    onclick="loadEditData({{ $admin }})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('dataadmin.destroy', $admin->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $admins->links() }}</div>
</div>

<!-- Modal Tambah Admin -->
<div class="modal fade" id="modalTambahAdmin" tabindex="-1" aria-labelledby="modalTambahAdminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('dataadmin.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahAdminLabel">Tambah Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Admin -->
<div class="modal fade" id="modalEditAdmin" tabindex="-1" aria-labelledby="modalEditAdminLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editAdminForm" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditAdminLabel">Edit Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="edit_fullname" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="edit_fullname" name="fullname" required>
                </div>
                <div class="mb-3">
                    <label for="edit_username" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="edit_username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="edit_password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="edit_password" name="password">
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
function loadEditData(admin) {
    document.getElementById('edit_fullname').value = admin.fullname;
    document.getElementById('edit_username').value = admin.username;
    document.getElementById('editAdminForm').action = `/admin/${admin.id}`;
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#tableAdmin').DataTable();
    });
</script>
@endsection
