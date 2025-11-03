@extends('layouts.app')

@section('content')
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="close btn-close-alert" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <div class="card shadow">
    <div class="card-header">
      <h2 class="m-0 font-weight-bold text-primary h4">Profil</h2>
    </div>
    <div class="card-body">
      <form>
        @csrf
        <div class="row mb-3">
          <div class="col-2">
            Nama
          </div>
          <div class="col-4">
            <input type="text" class="form-control" name="name" value="{{ $profile->name ?? '' }}">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-2">
            Username
          </div>
          <div class="col-4">
            <input type="text" class="form-control" name="username" value="{{ $profile->username ?? '' }}">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-2">
            Email
          </div>
          <div class="col-4">
            <input type="text" class="form-control" name="email" value="{{ $profile->email ?? '' }}">
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-2">
            Telepon
          </div>
          <div class="col-4">
            <input type="text" class="form-control" name="phone" value="{{ $profile->phone ?? '' }}" oninput="this.value = this.value.replace(/[^\d.]/g, '')">
          </div>
        </div>
        <div class="row justify-content-center d-flex">
          <div class="col-6">
            <button type="submit" class="btn-update-data btn btn-primary px-4 mr-3">
              <i class="fas fa-sync-alt mr-1"></i>
              <strong>Update Data</strong>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('script')
<script>
  $(document).ready(function() {
    // === UPDATE PROFILE ===
    $(document).on('submit', 'form', function (e) {
      e.preventDefault();

      let url = "{{ route('profile.update') }}";

      $.ajax({
        url: url,
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $(this).serialize(),
        success: function(response) {
          alert(response.message);
          window.location.href = response.redirect
        },
        error: function(error) {
          alert('gagal update: ' + error.responseJSON.message);
        }
      });
    });
  });
</script>
@endpush
