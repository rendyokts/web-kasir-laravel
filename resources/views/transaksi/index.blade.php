@extends('layouts.master')

@section('page-css')
    {{-- Gunakan CSS bawaan dari Portos atau Bootstrap 5 jika perlu --}}
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/@form-validation/form-validation.css') }}" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" />

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
                            <h5 class="card-title m-0">Transaksi</h5>
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
                        <div class="card-body table-responsive">
                            <div class="row mb-3">
                                <div class="col-md-6 d-flex align-items-center gap-2 flex-wrap"
                                    id="custom-buttons-container">
                                    <a href="#" id="exportExcel" class="btn btn-success btn-sm">
                                        <i class="menu-icon icon-base ti tabler-file-type-xls"></i> Export Excel
                                    </a>
                                </div>

                                <div class="col-md-3">
                                    <select id="filter-bulan" class="form-control form-select">
                                        <option value="">Pilih Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">
                                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="filter-tahun" class="form-control form-select">
                                        <option value="">Pilih Tahun</option>
                                        @for ($y = now()->year; $y >= 2022; $y--)
                                            <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <table class="table table-bordered table-striped" id="table-transaksi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kode Transaksi</th>
                                        <th>Kasir</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
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
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('portos/assets/js/tables-datatables-basic.js') }}"></script>

    <!-- Buttons for Excel and PDF -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            const table = $('#table-transaksi').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('transaksi.json') }}',
                    data: function(d) {
                        d.bulan = $('#filter-bulan').val();
                        d.tahun = $('#filter-tahun').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'kode_transaksi',
                        name: 'kode_transaksi'
                    },
                    {
                        data: 'user_nama',
                        name: 'user_nama'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ],
                initComplete: function() {
                    table.buttons().container().appendTo('#custom-buttons-container');
                }
            });

            $('#filter-bulan, #filter-tahun').on('change', function() {
                table.draw();
            });
        });
    </script>
    <script>
        $('#exportExcel').on('click', function(e) {
            e.preventDefault();
            const bulan = $('#filter-bulan').val();
            const tahun = $('#filter-tahun').val();
            const url = `{{ route('transaksi.export') }}?bulan=${bulan}&tahun=${tahun}`;
            window.location.href = url;
        });
    </script>
@endsection
