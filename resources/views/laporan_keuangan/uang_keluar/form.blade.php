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
                            <h5 class="mb-0">Laporan Uang Keluar</h5>
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
                            <form method="post" action="{{ route('laporan_keuangan.tambah_pengeluaran.save') }}"
                                id="formUser" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                {{-- Input hidden jangan lupa ditambahkan untuk melakukan pengecekan id apabila sudah ada maka bisa dilakukan edit, jika kosong akan dilakukan tambah user --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="tanggal">Tanggal Uang Keluar <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="tanggal2" class="input-group-text"><i
                                                        class="icon-base ti tabler-calendar"></i></span>
                                                <input type="date" id="tanggal" name="tanggal" class="form-control"
                                                    required value="{{ old('tanggal', $data->tanggal ?? '') }}" autofocus />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="keterangan">Keterangan<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="keterangan" class="input-group-text"><i
                                                        class="icon-base ti tabler-pencil"></i></span>
                                                <input type="text" class="form-control" name="keterangan" id="keterangan"
                                                    placeholder="Keterangan" required aria-describedby="keterangan"
                                                    value="{{ old('keterangan', $data->keterangan ?? '') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="jumlah">Jumlah Uang Keluar<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="jumlah2" class="input-group-text"><i
                                                        class="icon-base ti tabler-cash-register"></i></span>
                                                <input type="text" id="jumlah" name="jumlah" class="form-control"
                                                    required placeholder="Rp"
                                                     value="{{ number_format(old('jumlah', $data->jumlah, 0, ',', '.' ?? '')) }}"
                                                    aria-describedby="jumlah" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-6">
                                            <label class="form-label" for="file_lampiran">File Lampiran<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group input-group-merge">
                                                <span id="file_lampiran2" class="input-group-text"><i
                                                        class="icon-base ti tabler-file"></i></span>
                                                <input type="file" id="file_lampiran" name="file_lampiran"
                                                    class="form-control" @if (!isset($data)) required @endif
                                                    aria-describedby="file_lampiran" />
                                            </div>

                                            @if (isset($data) && $data->file_lampiran)
                                                <div class="mt-2">
                                                    <a href="{{ asset('storage/' . $data->file_lampiran) }}" target="_blank"
                                                        class="btn btn-info btn-sm">
                                                        <i class="icon-base ti tabler-download"></i> Download Lampiran Lama
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <button type="button" class="btn btn-primary btn-sm" id="btnSimpan">Simpan</button>
                                <a href="{{ route('laporan_keuangan.uang_keluar') }}"
                                    class="btn btn-danger btn-sm">Kembali</a>
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
    <script>
        // Format input uang saat diketik
        const inputJumlah = document.getElementById('jumlah');

        inputJumlah.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, ''); // Hapus semua non-digit
            if (!value) {
                this.value = '';
                return;
            }

            // Format ribuan pakai titik
            this.value = new Intl.NumberFormat('id-ID').format(value);
        });
    </script>
@endsection
