@extends('admin.layout')
@section('title', 'Data Anggota - Pustaka Nusa')
@section('content')
<div class="p-1">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center">
            <h1 class="mb-0 me-3">Data Anggota</h1>
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
                    <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Button Tambah Anggota -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">+ Tambah Anggota</button>

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Anggota</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggota as $key => $item)
                        <tr>
                            <td>{{ $anggota->firstItem() + $key }}</td>
                            <td>{{ $item->kode_user }}</td>
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <!-- Button Edit Anggota -->
                                <button class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditAnggota"
                                        onclick="loadEditData({{ $item }})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <!-- Hapus Anggota -->
                                <form action="{{ route('anggota.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No data available in table</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $anggota->links() }}
    </div>
</div>

<!-- Modal Tambah Anggota -->
<div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-labelledby="modalTambahAnggotaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahAnggotaLabel">Tambah Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('anggota.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_user" class="form-label">Kode Anggota</label>
                        <input type="text" class="form-control" id="kode_user" name="kode_user" value="{{ $newKodeUser }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            <option value="Fakultas Kedokteran">Pilih Kelas</option>
                            <option value="Fakultas Kedokteran">Fakultas Kedokteran</option>
                            <option value="Fakultas Ekonomi">Fakultas Ekonomi</option>
                            <option value="Fakultas Teknologi Informasi">Fakultas Teknologi Informasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
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

<!-- Modal Edit Anggota -->
<div class="modal fade" id="modalEditAnggota" tabindex="-1" aria-labelledby="modalEditAnggotaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditAnggotaLabel">Edit Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAnggotaForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_kode_user" class="form-label">Kode Anggota</label>
                        <input type="text" class="form-control" id="edit_kode_user" name="kode_user" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit_fullname" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="edit_fullname" name="fullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="edit_username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="edit_password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="edit_kelas" class="form-label">Kelas</label>
                        <select class="form-control" id="edit_kelas" name="kelas" required>
                            <option value="Fakultas Kedokteran">Pilih Kelas</option>
                            <option value="Fakultas Kedokteran">Fakultas Kedokteran</option>
                            <option value="Fakultas Ekonomi">Fakultas Ekonomi</option>
                            <option value="Fakultas Teknologi Informasi">Fakultas Teknologi Informasi</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required></textarea>
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
    document.getElementById('edit_kode_user').value = item.kode_user;
    document.getElementById('edit_fullname').value = item.fullname;
    document.getElementById('edit_username').value = item.username;
    document.getElementById('edit_email').value = item.email;
    document.getElementById('edit_kelas').value = item.kelas;
    document.getElementById('edit_alamat').value = item.alamat;
    document.getElementById('editAnggotaForm').action = `/anggota/${item.id}`;
}
</script>
