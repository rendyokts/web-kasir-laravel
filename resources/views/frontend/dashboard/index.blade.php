@extends('layouts.master')

@section('page-css')
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">

        
            @include('frontend.dashboard.dashboard')

        {{-- @include('portos.layouts.footer')  --}}

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection

@section('page-js')
@endsection
