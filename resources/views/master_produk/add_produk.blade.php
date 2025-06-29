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
                            <h5 class="mb-0">Manajemen Produk</h5>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="d-flex flex-column justify-start align-content-center mb-1 p-0">
                                    @foreach ($errors->all() as $error)
                                        <li class="list-group-item ">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <form method="post" action="{{ route('master_produk.save') }}" id="formProduk" enctype="multipart/form-data">
                                @csrf
                                {{-- Cross Site Resource Forgery --}}
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                {{-- Input hidden jangan lupa ditambahkan untuk melakukan pengecekan id apabila sudah ada maka bisa dilakukan edit, jika kosong akan dilakukan tambah user --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="kode-barang">Kode Barang <span
                                                    class="text-danger">*</span><span class="text-secondary"></span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="kode_barang2" class="input-group-text"><i
                                                        class="icon-base ti tabler-shopping-cart-code"></i></span>
                                                <input type="text" id="kode_barang" name="kode_barang"
                                                    class="form-control" placeholder="Masukan Kode Produk"
                                                    aria-label="kode barang" required
                                                    value="{{ old('kode_barang', $data->kode_barang ?? '') }}"
                                                    aria-describedby="kode_barang2" />
                                            </div>
                                            <div class="form-text"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="nama-barang">Nama Produk <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="name2" class="input-group-text"><i
                                                        class="icon-base ti tabler-pencil"></i></span>
                                                <input type="text" class="form-control" name="nama_barang"
                                                    id="nama_barang" placeholder="Masukan Nama Produk"
                                                    aria-label="Kopi Hitam" autofocus required
                                                    aria-describedby="nama_barang2"
                                                    value="{{ old('nama_barang', $data->nama_barang ?? '') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label for="kategori" class="form-label">Kategori <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="kategori_id" name="kategori_id" required>
                                                <option selected disabled value="">Pilih Kategori</option>
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}"
                                                        {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                        {{ $kategori->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="harga_barang">Harga Barang <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="harga_barang2" class="input-group-text"><i
                                                        class="icon-base ti tabler-coin"></i></span>
                                                <input type="number" id="harga_barang" name="harga_barang"
                                                    class="form-control phone-mask" placeholder="1000" aria-label="1000"
                                                    aria-describedby="harga_barang2" required
                                                    value="{{ old('telp', $data->harga_barang ?? '') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="stok">Stok Barang <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="stok2" class="input-group-text"><i
                                                        class="icon-base ti tabler-brand-unsplash"></i></span>
                                                <input type="number" id="stok" name="stok"
                                                    class="form-control phone-mask" placeholder="0" aria-label="0"
                                                    aria-describedby="stok2" required
                                                    value="{{ old('telp', $data->stok ?? '') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="gambar_produk">Gambar Barang<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="gambar_produk2" class="input-group-text"><i
                                                        class="icon-base ti tabler-file"></i></span>
                                                <input type="file" id="gambar_produk" name="gambar_produk"
                                                    class="form-control" @if (!isset($data)) required @endif
                                                    aria-describedby="gambar_produk"/>
                                            </div>

                                            @if (isset($data) && $data->gambar_produk)
                                                <div class="mt-2">
                                                    <a href="{{ asset('storage/' . $data->gambar_produk) }}" target="_blank"
                                                        class="btn btn-info btn-sm">
                                                        <i class="icon-base ti tabler-download"></i> Download Gambar
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary btn-sm" id="btnSimpan">Simpan</button>
                                <a href="{{ route('master_produk.index') }}" class="btn btn-danger btn-sm">Kembali</a>
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
                    document.getElementById('formProduk').submit();
                }
            });
        });
    </script>
@endsection