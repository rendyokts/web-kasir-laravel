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
                            <h5 class="mb-0">Manajemen Kategori</h5>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="d-flex flex-column justify-start align-content-center mb-1 p-0">
                                        @foreach ($errors->all() as $error)
                                            <li class="list-group-item ">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('laporan_keuangan.tambah_pemasukan.save') }}"
                                id="formUser">
                                @csrf
                                {{-- Cross Site Resource Forgery --}}
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                {{-- Input hidden jangan lupa ditambahkan untuk melakukan pengecekan id apabila sudah ada maka bisa dilakukan edit, jika kosong akan dilakukan tambah user --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="username">Kode Kategori <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="username2" class="input-group-text"><i
                                                        class="icon-base ti tabler-category"></i></span>
                                                <input type="text" id="kode_kategori" name="kode_kategori"
                                                    class="form-control" placeholder="Kode Kategori"
                                                    aria-label="Kode Kategori" required
                                                    value="{{ old('kode_kategori', $data->kode_kategori ?? '') }}"
                                                    aria-describedby="username2" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="name">Nama Kategori <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="name2" class="input-group-text"><i
                                                        class="icon-base ti tabler-pencil"></i></span>
                                                <input type="text" class="form-control" name="nama" id="nama"
                                                    placeholder="Nama Kategori" aria-label="Nama Kategori" autofocus
                                                    required aria-describedby="name2"
                                                    value="{{ old('nama', $data->nama ?? '') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary btn-sm" id="btnSimpan">Simpan</button>
                                <a href="{{ route('master_category.index') }}" class="btn btn-danger btn-sm">Kembali</a>
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
