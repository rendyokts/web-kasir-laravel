@extends('layouts.master')
@section('page-css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Change Password -->
                <div class="card mb-6">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body pt-1">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="d-flex flex-column justify-start align-content-center mb-1 p-0">
                                    @foreach ($errors->all() as $error)
                                        <li class="list-group-item ">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="formAccountSettings" action="{{ route('change.password') }}" method="POST">
                            @csrf
                            @if (auth()->user()->regist_by_google !== 2)
                                <div class="row mb-sm-6 mb-2">
                                    <div class="col-md-6 form-password-toggle form-control-validation">
                                        <label class="form-label" for="password-lama">Password Lama</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="password" name="password_lama"
                                                id="password_lama"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="icon-base ti tabler-eye-off icon-xs"></i></span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row gy-sm-6 gy-2 mb-sm-0 mb-2">
                                <div class="mb-6 col-md-6 form-password-toggle form-control-validation">
                                    <label class="form-label" for="password-baru">Password Baru</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" id="password_baru" name="password_baru"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="icon-base ti tabler-eye-off icon-xs"></i></span>
                                    </div>
                                </div>

                                <div class="mb-6 col-md-6 form-password-toggle form-control-validation">
                                    <label class="form-label" for="confirm-Password">Konfirmasi Password Baru</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="password_baru_confirmation"
                                            id="password_baru_confirmation"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="icon-base ti tabler-eye-off icon-xs"></i></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-body">Password Requirements:</h6>
                            <ul class="ps-4 mb-0">
                                <li class="mb-4">Minimal panjang 8 karakter atau lebih</li>
                                <li class="mb-4">At least one lowercase character</li>
                            </ul>
                            <div class="mt-6">
                                <button type="button" class="btn btn-primary me-3 btn-sm" id="btn-submit">Simpan</button>
                                <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/ Change Password -->

            </div>
        </div>
    </div>
@endsection

@section('page-js')
<script>
        document.getElementById('btn-submit').addEventListener('click', function() {
                Swal.fire({
                    title: 'Yakin ingin menyimpan?',
                    text: "Harap di ingat password baru Anda!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                          document.getElementById('formAccountSettings').submit();
                    }
                });
            });
    </script>
@endsection
