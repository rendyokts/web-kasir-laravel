@extends('layouts.master')
@section('page-css')
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Manajemen User</h5>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('master_user.save') }}" id="formUser">
                                @csrf
                                {{-- Cross Site Resource Forgery --}}
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                {{-- Input hidden jangan lupa ditambahkan untuk melakukan pengecekan id apabila sudah ada maka bisa dilakukan edit, jika kosong akan dilakukan tambah user --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="name">Nama Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="name2" class="input-group-text"><i
                                                        class="icon-base ti tabler-user"></i></span>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    placeholder="John Doe" aria-label="John Doe" autofocus required
                                                    aria-describedby="name2" value="{{ old('name', $data->name ?? '') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="username">Username <span
                                                    class="text-danger">*</span><span class="text-secondary"> Gunakan huruf
                                                    kecil semua</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="username2" class="input-group-text"><i
                                                        class="icon-base ti tabler-building"></i></span>
                                                <input type="text" id="username" name="username" class="form-control"
                                                    placeholder="username" aria-label="username" required
                                                    value="{{ old('username', $data->username ?? '') }}"
                                                    aria-describedby="username2" />
                                            </div>
                                            <div class="form-text"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="email">Email <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i
                                                        class="icon-base ti tabler-mail"></i></span>
                                                <input type="text" id="email" name="email" class="form-control"
                                                    placeholder="john.doe@gmail.com" aria-label="john.doe@gmail.com"
                                                    aria-describedby="email2" required
                                                    value="{{ old('email', $data->email ?? '') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="telepon">Telepon <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="telepon2" class="input-group-text"><i
                                                        class="icon-base ti tabler-phone"></i></span>
                                                <input type="text" id="telepon" name="telepon"
                                                    class="form-control phone-mask" placeholder="08 799 8941"
                                                    aria-label="0858 799 8941" aria-describedby="telepon2" required
                                                    value="{{ old('telepon', $data->telepon ?? '') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label for="role" class="form-label">Role <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="role" name="role"
                                                aria-label="Default select example" required>
                                                <option selected disabled value="">Pilih Role</option>
                                                <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                                <option value="kasir" {{ $data->role == 'kasir' ? 'selected' : '' }}>Kasir
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label for="status" class="form-label">Status <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="status" name="status"
                                                aria-label="Default select example" required>
                                                <option selected disabled value="">Pilih Status</option>
                                                <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Non-Aktif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary btn-sm" id="btnSimpan">Simpan</button>
                                <a href="{{ route('master_user.index') }}" class="btn btn-danger btn-sm">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('btnSimpan').addEventListener('click', function() {
            Swal.fire({
                title: 'Yakin ingin simpan?',
                text: "Pastikan data sudah benar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formUser').submit();
                }
            });
        });
    </script>
@endsection
