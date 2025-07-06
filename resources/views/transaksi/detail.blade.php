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
                        <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                            <h5 class="card-title m-0">Nomor transaksi: {{ $transaksi->kode_transaksi }}<p
                                    class="text-muted m-0 mt-1">
                                    <small>Tanggal:
                                        {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y H:i') }}</small>
                                </p>
                            </h5>

                            <a href="{{ route('transaksi.list') }}" class="btn btn-danger">
                                Kembali
                            </a>
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
                                        <th>Nama Barang</th>
                                        <th>Gambar</th>
                                        <th>QTY</th>
                                        <th>Harga Satuan</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($transaksi->details as $q)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $q->produk->nama_barang }}</td>
                                            <td><img src="{{ asset('storage/' . $q->produk->gambar_produk) }}"
                                                    alt="Gambar Produk" width="60" height="60"
                                                    style="object-fit: cover; border-radius: 4px;"></td>
                                            <td>{{ $q->qty }}</td>
                                            <td>Rp {{ number_format($q->harga_satuan, 0, 2) }}</td>
                                            <td>Rp {{ number_format($q->subtotal, 0, 2) }}</td>
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
@endsection
