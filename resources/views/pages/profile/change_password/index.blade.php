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
      <h2 class="m-0 font-weight-bold text-primary h4">Ganti Password</h2>
    </div>
    <div class="card-body">
      <form method="post">
        @csrf
        <div class="row mb-3">
          <div class="col-2">
            Password Lama
          </div>
          <div class="col-4">
            <input type="password" class="form-control" name="current_password" value="">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-2">
            Password Baru
          </div>
          <div class="col-4">
            <input type="password" class="form-control" name="new_password" value="">
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-2">
            Konfirmasi Password Baru
          </div>
          <div class="col-4">
            <input type="password" class="form-control" name="new_password_confirmation" value="">
          </div>
        </div>
        <div class="row justify-content-center d-flex">
          <div class="col-6">
            <button type="submit" class="btn-update-data btn btn-info px-4 mr-3">
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

      let url = "{{ route('profile.password.update', $profile->id) }}";

      $.ajax({
        url: url,
        type: 'PUT',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $(this).serialize(),
        success: function(response) {
          alert('berhasil update password', response);
        },
        error: function(error) {
          alert('gagal update password', error);
        }
      });
    });
  });
</script>
@endpush
