@extends('layouts.app')

@push('style')
  <style>
    .toggle-password {
        border: 1px solid #ced4da;
        border-left: none;
        transition: all 0.3s ease;
    }

    .toggle-password:hover {
        background-color: #e9ecef;
        border-color: #adb5bd;
    }

    .toggle-password.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .input-group .form-control:focus {
        z-index: 1;
    }

    .input-group .toggle-password:focus {
        z-index: 2;
        box-shadow: none;
    }
  </style>
@endpush

@section('content')
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
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
      <form id="updatePasswordForm" method="POST" action="{{ route('profile.password.update') }}">
        @csrf
        @method('PUT')
        
        <div class="row mb-3">
          <div class="col-md-2 col-form-label">
            <label for="current_password" class="font-weight-bold">Password Lama</label>
          </div>
          <div class="col-md-4">
            <div class="input-group">
              <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                     name="current_password" id="current_password" required
                     placeholder="Masukkan password lama">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="current_password">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
              @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="row mb-3">
          <div class="col-md-2 col-form-label">
            <label for="new_password" class="font-weight-bold">Password Baru</label>
          </div>
          <div class="col-md-4">
            <div class="input-group">
              <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                     name="new_password" id="new_password" required
                     placeholder="Masukkan password baru">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="new_password">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
              @error('new_password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            {{-- <small class="form-text text-muted">
              Minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka
            </small> --}}
          </div>
        </div>
        
        <div class="row mb-5">
          <div class="col-md-2 col-form-label">
            <label for="new_password_confirmation" class="font-weight-bold">Konfirmasi Password Baru</label>
          </div>
          <div class="col-md-4">
            <div class="input-group">
              <input type="password" class="form-control" 
                     name="new_password_confirmation" id="new_password_confirmation" required
                     placeholder="Konfirmasi password baru">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="new_password_confirmation">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row justify-content-center">
          <div class="col-md-6 text-center">
            <button type="submit" class="btn btn-primary px-4" id="submitButton">
              <i class="fas fa-sync-alt mr-1"></i>
              <span class="btn-text">Update Password</span>
              <div class="spinner-border spinner-border-sm d-none" role="status" id="loadingSpinner">
                <span class="sr-only">Loading...</span>
              </div>
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
    const $form = $('#updatePasswordForm');
    const $submitButton = $('#submitButton');
    const $btnText = $submitButton.find('.btn-text');
    const $loadingSpinner = $('#loadingSpinner');

    // Toggle Password Visibility
    $('.toggle-password').on('click', function() {
        const targetId = $(this).data('target');
        const $passwordInput = $('#' + targetId);
        const $icon = $(this).find('i');
        
        // Toggle input type
        const type = $passwordInput.attr('type') === 'password' ? 'text' : 'password';
        $passwordInput.attr('type', type);
        
        // Toggle icon
        if (type === 'text') {
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            $(this).addClass('active');
        } else {
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
            $(this).removeClass('active');
        }
    });

    // Form submission
    $form.on('submit', function(e) {
        e.preventDefault();

        // Reset previous errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        // Show loading state
        $submitButton.prop('disabled', true);
        $btnText.addClass('d-none');
        $loadingSpinner.removeClass('d-none');

        $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(response) {
                showAlert('Password berhasil diperbarui!', 'success');
                $form[0].reset();
                
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    showValidationErrors(errors);
                    showAlert('Terjadi kesalahan validasi', 'error');
                } else {
                    showAlert('Terjadi kesalahan sistem', 'error');
                }
            },
            complete: function() {
                $submitButton.prop('disabled', false);
                $btnText.removeClass('d-none');
                $loadingSpinner.addClass('d-none');
            }
        });
    });

    function showValidationErrors(errors) {
        $.each(errors, function(field, messages) {
            const $input = $(`[name="${field}"]`);
            const $inputGroup = $input.closest('.input-group');
            
            $input.addClass('is-invalid');
            
            if ($inputGroup.length) {
                $inputGroup.after(`<div class="invalid-feedback d-block">${messages[0]}</div>`);
            }
        });
    }

    function showAlert(message, type) {
        $('.alert-dismissible').remove();
        
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                <strong>${message}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        
        $('.card-header').after(alertHtml);
        
        setTimeout(() => {
            $('.alert-dismissible').alert('close');
        }, 5000);
    }

    // Optional: Password strength indicator
    $('#new_password').on('keyup', function() {
        const password = $(this).val();
        updatePasswordStrength(password);
    });

    function updatePasswordStrength(password) {
        // Implementasi strength indicator bisa ditambahkan di sini
        // Contoh: tambahkan progress bar atau warna border
    }
});
</script>
@endpush