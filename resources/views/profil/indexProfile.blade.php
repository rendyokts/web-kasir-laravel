@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar Profil -->
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <div class="position-relative mb-3">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ Storage::url(auth()->user()->foto_profil) }}" 
                                 class="rounded-circle img-thumbnail" 
                                 width="150" height="150" 
                                 alt="Foto Profil">
                        @else
                            <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center bg-primary text-white" 
                                 style="width:150px; height:150px; font-size: 3rem; margin: 0 auto;">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted small">{{ auth()->user()->email }}</p>
                    
                    <form action="{{ route('profil.upload_foto') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="input-group">
                            <input type="file" name="foto_profil" class="form-control form-control-sm d-none" id="uploadFoto">
                            <label for="uploadFoto" class="btn btn-sm btn-outline-primary w-100">
                                <i class="fas fa-camera me-2"></i>Ubah Foto
                            </label>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success w-100 mt-2">
                            <i class="fas fa-upload me-2"></i>Upload
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="list-group shadow-sm">
                <a href="{{ route('profil.index') }}" 
                   class="list-group-item list-group-item-action active">
                   <i class="fas fa-user-circle me-2"></i>Profil Saya
                </a>
                <a href="{{ route('profil.edit') }}" 
                   class="list-group-item list-group-item-action">
                   <i class="fas fa-user-edit me-2"></i>Edit Profil
                </a>
                <a href="{{ route('profil.ganti_password') }}" 
                   class="list-group-item list-group-item-action">
                   <i class="fas fa-lock me-2"></i>Ganti Password
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Informasi Profil</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nama Lengkap:</div>
                        <div class="col-md-8">{{ auth()->user()->name }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8">{{ auth()->user()->email }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nomor Telepon:</div>
                        <div class="col-md-8">{{ auth()->user()->telepon ?? '<span class="text-muted">Belum diisi</span>' }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Alamat:</div>
                        <div class="col-md-8">{{ auth()->user()->alamat ?? '<span class="text-muted">Belum diisi</span>' }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Bergabung Pada:</div>
                        <div class="col-md-8">{{ auth()->user()->created_at->format('d F Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .avatar-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 150px;
        height: 150px;
        background-color: #0d6efd;
        color: white;
        font-weight: bold;
        font-size: 3rem;
        border-radius: 50%;
    }
    .list-group-item.active {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .card {
        border-radius: 10px;
    }
</style>
@endpush