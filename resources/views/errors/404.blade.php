@extends('layouts.app_fe')

@section('content')
  <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="text-center">
      <div class="error mx-auto" data-text="404">404</div>
      <p class="lead text-gray-800 mb-5">Page Not Found</p>
      <p class="text-gray-500 mb-0">Halaman yang Anda cari tidak ditemukan</p>
      <a href="{{ url('/') }}">&larr; Back</a>
    </div>
  </div>
@endsection