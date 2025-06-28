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
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <!-- Card Header -->
                        <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                            <h5 class="card-title m-0">Pengeluaran dan Pemasukan    </h5>
                            {{-- Ubah bagian atas untuk header --}}
                            <div class="d-flex gap-2">
                                <a href="{{ route('laporan_keuangan.uang_masuk') }}" class="btn btn-primary">
                                    Pemasukan
                                </a>
                                <a href="{{ route('laporan_keuangan.uang_keluar') }}" class="btn btn-danger">
                                    Pengeluaran
                                </a>
                            </div>

                        </div>

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
                                        <th>Kode Kategori</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {{-- CLIENT SIDE --}}
                                    {{-- Looping Foreach --}}
                                    {{-- @foreach ($query as $q)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $q->kode_kategori }}</td>
                                            <td>{{ $q->nama }}</td>
                                            <td>
                                                <a href="{{ route('master_category.edit', ['id' => $q->id]) }}"
                                                    class="btn btn-warning btn-sm">Ubah</a>
                                                <a href="javascript:void(0);" data-id="{{ $q->id }}"
                                                    class="btn btn-danger btn-sm btn-delete">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach --}}
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
                        form.setAttribute('action', `/delete_category/${userId}`);
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
