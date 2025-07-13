@extends('layouts.master')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-6">
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

                                    <a href="{{ route('profil.ganti-password') }}" class="btn btn-primary">Ubah Password</a>
                                    <a href="{{ route('dashboard') }}" type="button" class="btn btn-danger btn-sm">Kembali</a>

                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
