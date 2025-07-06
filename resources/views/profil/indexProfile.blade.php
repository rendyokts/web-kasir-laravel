@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-6">
                    <!-- Account -->
                    {{-- <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-6">
                            <img src="{{ asset('portos/assets/img/avatars/user.png') }}" alt="user-avatar"
                                class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="icon-base ti tabler-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                                    <i class="icon-base ti tabler-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body pt-4">
                        <form id="formAccountSettings" method="POST" onsubmit="return false">
                            <div class="row gy-4 gx-6 mb-6">
                                <div class="col-md-6 form-control-validation">
                                    <label for="firstName" class="form-label">Nama</label>
                                    <input class="form-control" type="text" id="firstName" name="firstName"
                                        value="{{ $user->name }}" disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $user->email }}" disabled />
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                    <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                        placeholder="202 555 0111" value="{{ $user->telp }}" disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ $user->username }}" disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="state" class="form-label">Role</label>
                                    <input class="form-control" type="text" id="state" name="state"
                                        value="{{ $user->role }}" disabled />
                                </div>
                                <div class="col-md-6">
                                    <label for="zipCode" class="form-label">Status</label>
                                    <input type="text" class="form-control" id="zipCode" name="zipCode"
                                        value="{{ $user->status = 1 ? 'Aktif' : 'Tidak Aktif' }}" disabled />
                                </div>
                                <div class="mt-5">
                                    {{-- <a href="{{ route('profil.ganti_password') }}" class="btn btn-primary">Ubah Password</a> --}}
                                    <a href="{{ route('dashboard') }}" type="button" class="btn btn-danger">Kembali</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
