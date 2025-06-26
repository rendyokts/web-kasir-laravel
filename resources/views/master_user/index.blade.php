@extends('layouts.master')

@section('page-css')
    {{-- Gunakan CSS bawaan dari Portos atau Bootstrap 5 jika perlu --}}
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('portos/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
@endsection

@section('content')
    @if (session('user_saved'))
        <!-- Modal -->
        <div class="modal fade" id="userSavedModal" tabindex="-1" aria-labelledby="userSavedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="userSavedModalLabel">User Berhasil Disimpan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Nama:</strong> {{ session('user_saved')->name }}</p>
                        <p><strong>Username:</strong> {{ session('user_saved')->username }}</p>
                        <p><strong>Email:</strong> {{ session('user_saved')->email }}</p>
                        <p><strong>Telp:</strong> {{ session('user_saved')->telp }}</p>
                        <p><strong>Role:</strong> {{ session('user_saved')->role }}</p>
                        <p><strong>Status:</strong> {{ session('user_saved')->status == 1 ? 'Aktif' : 'Non-Aktif' }}</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <!-- Card Header -->
                        <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                            <h5 class="card-title m-0">Master User Management</h5>
                            {{-- Ubah bagian atas untuk header --}}
                            <a href="{{ route('master_user.add_user') }}" class="btn btn-primary">
                                Tambah User
                            </a>
                            {{-- Button nya --}}
                        </div>

                        <!-- Alert -->
                        {{-- <div class="alert alert-primary alert-dismissible m-3" role="alert">
                            Silahkan tarik data PKK Inaportnet jika nomor PKK tidak ada dalam list!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> --}}

                        @if (session('toast_success'))
                            <div class="alert alert-success fade show m-3" role="alert">
                                {{ session('toast_success') }}
                            </div>
                        @endif

                        @if (session('toast_error'))
                            <div class="alert alert-danger fade show m-3" role="alert">
                                {{ session('toast_error') }}
                            </div>
                        @endif
                        <form id="formDeleteUser" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>


                        <!-- Table -->
                        <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered" id="listPkk">
                                <thead>
                                    <tr>
                                        <th width="10">No</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- CLIENT SIDE --}}
                                    {{-- Looping Foreach --}}
                                    @foreach ($query as $q)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- Looping Nomor --}}
                                            <td>{{ $q->name }}</td>
                                            <td>{{ $q->telp }}</td>
                                            <td>{{ $q->email }}</td>
                                            @php
                                                $statusLabels = [
                                                    1 => ['class' => 'success', 'text' => 'Aktif'],
                                                    2 => ['class' => 'danger', 'text' => 'Tidak Aktif'],
                                                ];
                                                $status = $statusLabels[$q->status];
                                                $roleLabels = [
                                                    'kasir' => ['class' => 'secondary', 'text' => 'Kasir'],
                                                    'admin' => ['class' => 'info', 'text' => 'Admin'],
                                                ];
                                                $role = $roleLabels[$q->role];
                                            @endphp
                                            <td><span class="badge bg-{{ $status['class'] }}">{{ $status['text'] }}</span>
                                            </td>
                                            <td><span class="badge bg-{{ $role['class'] }}">{{ $role['text'] }}</span>
                                            <td>
                                                <a href="{{ route('master_user.edit', ['id' => $q->id]) }}"
                                                    class="btn btn-warning btn-sm">Ubah</a>
                                                <a href="javascript:void(0);" data-id="{{ $q->id }}"
                                                    class="btn btn-danger btn-sm btn-delete">Hapus</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="{{ asset('portos/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('portos/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('portos/assets/js/tables-datatables-basic.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('formDeleteUser');
                        form.setAttribute('action', `/delete/${userId}`);
                        form.submit();
                    }
                });
            });
        });
    </script>
    @if (session('user_saved'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = new bootstrap.Modal(document.getElementById('userSavedModal'));
                modal.show();
            });
        </script>
    @endif
@endsection
