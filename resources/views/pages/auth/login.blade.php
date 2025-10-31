{{-- @extends('layouts.app_welcome')

@push('style')
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
    
    .font-body {
        font-family: 'Inter', sans-serif;
    }
    
    .elegant-bg {
        background: linear-gradient(135deg, #f0f8ff 0%, #f5faff 100%);
    }
    
    .color-primary {
        background-color: #4e73df;
    }
</style>
@endpush

@section('content')
  <div class="min-h-screen flex items-center justify-center p-4 elegant-bg">
    <div class="w-full max-w-sm">
      <div class="bg-white p-8 md:p-10 rounded-xl shadow-2xl border border-blue-200 transform transition duration-500 hover:shadow-3xl">
        <div class="text-center mb-8">
          <h2 class="text-3xl font-bold text-[#4e73df]">
            Dashboard Login
          </h2>
        </div>
        
        <form method="POST" action="{{ route('login.action') }}">
          @csrf
          <div class="mb-5">
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
              Username
            </label>
            <input type="text" id="username" name="username" required autofocus 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4e73df] focus:border-[#4e73df] transition duration-150"
              placeholder="Masukkan Username Anda">
          </div>
          <div class="mb-8">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
              Password
            </label>
            <div class="relative">
              <input type="password" id="password" name="password" required 
                class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4e73df] focus:border-[#4e73df] transition duration-150"
                placeholder="Masukkan Password Anda">
              <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                <!-- Eye icon for show password --><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="eye-open">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <!-- Eye slash icon for hide password (initially hidden) --><svg class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="eye-closed">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .98-3.14 3.033-5.599 5.864-7.072m.063-.062A8.995 8.095 0 0112 5c4.478 0 8.268 2.943 9.542 7-.365 1.162-.832 2.247-1.391 3.235M7 7l10 10" />
                </svg>
              </button>
            </div>
          </div>

          <!-- Tombol Login -->
          <button type="submit" class="
            w-full 
            px-4 py-2 
            color-primary 
            text-white 
            font-semibold 
            rounded-lg 
            shadow-lg 
            hover:bg-blue-700 
            transition 
            duration-300 
            ease-in-out
            transform hover:scale-[1.01]
            focus:outline-none focus:ring-2 focus:ring-[#4e73df] focus:ring-offset-2
          ">
            Login ke Dashboard
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(function() {
    const $togglePassword = $('#togglePassword');
    const $passwordInput = $('#password');
    const $eyeOpen = $('#eye-open');
    const $eyeClosed = $('#eye-closed');

    $togglePassword.on('click', function () {
      // Toggle the type attribute
      const type = $passwordInput.attr('type') === 'password' ? 'text' : 'password';
      $passwordInput.attr('type', type);

      // Toggle the eye icon
      $eyeOpen.toggleClass('hidden');
      $eyeClosed.toggleClass('hidden');
    });
  });
</script>
@endpush --}}

{{-- ============== --}}

@extends('layouts.app_welcome')

@push('style')
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
    
    .font-body {
        font-family: 'Inter', sans-serif;
    }
    
    .elegant-bg {
        background: linear-gradient(135deg, #f0f8ff 0%, #f5faff 100%);
    }
    
    .color-primary {
        background-color: #4e73df;
    }
    
    .loading-spinner {
        display: none;
    }
    
    .btn-loading .loading-spinner {
        display: inline-block;
    }
    
    .btn-loading .btn-text {
        display: none;
    }
  </style>
@endpush

@section('content')
<div class="min-h-screen flex items-center justify-center p-4 elegant-bg">
  <div class="w-full max-w-sm">
    <div class="bg-white p-8 md:p-10 rounded-xl shadow-2xl border border-blue-200 transform transition duration-500 hover:shadow-3xl">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-[#4e73df]">
                Dashboard Login
            </h2>
        </div>
        
        <!-- Alert untuk menampilkan pesan error/success -->
        <div id="alertMessage" class="hidden mb-4 p-3 rounded-lg text-sm"></div>
        
        <form id="loginForm" method="POST" action="{{ route('login.action') }}">
            @csrf
            <div class="mb-5">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                    Username
                </label>
                <input type="text" id="username" name="username" required autofocus 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4e73df] focus:border-[#4e73df] transition duration-150 @error('username') border-red-500 @enderror"
                    placeholder="Masukkan Username atau Email"
                    value="{{ old('username') }}">
                <div id="usernameError" class="text-red-500 text-xs mt-1 hidden"></div>
            </div>
            
            <div class="mb-8">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <div class="relative">
                    <input type="password" id="password" name="password" required 
                        class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#4e73df] focus:border-[#4e73df] transition duration-150 @error('password') border-red-500 @enderror"
                        placeholder="Masukkan Password Anda">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="eye-open">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="eye-closed">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .98-3.14 3.033-5.599 5.864-7.072m.063-.062A8.995 8.095 0 0112 5c4.478 0 8.268 2.943 9.542 7-.365 1.162-.832 2.247-1.391 3.235M7 7l10 10" />
                        </svg>
                    </button>
                </div>
                <div id="passwordError" class="text-red-500 text-xs mt-1 hidden"></div>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="mb-6 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-[#4e73df] focus:ring-[#4e73df] border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-700">
                    Ingat saya
                </label>
            </div>

            <!-- Tombol Login -->
            <button type="submit" id="loginButton" class="
                w-full 
                px-4 py-2 
                color-primary 
                text-white 
                font-semibold 
                rounded-lg 
                shadow-lg 
                hover:bg-blue-700 
                transition 
                duration-300 
                ease-in-out
                transform hover:scale-[1.01]
                focus:outline-none focus:ring-2 focus:ring-[#4e73df] focus:ring-offset-2
                flex items-center justify-center
            ">
                <span class="btn-text">Login ke Dashboard</span>
                <div class="loading-spinner">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </button>
        </form>
    </div>
  </div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    const $togglePassword = $('#togglePassword');
    const $passwordInput = $('#password');
    const $eyeOpen = $('#eye-open');
    const $eyeClosed = $('#eye-closed');
    const $loginForm = $('#loginForm');
    const $loginButton = $('#loginButton');
    const $alertMessage = $('#alertMessage');

    // Toggle password visibility
    $togglePassword.on('click', function () {
        const type = $passwordInput.attr('type') === 'password' ? 'text' : 'password';
        $passwordInput.attr('type', type);
        $eyeOpen.toggleClass('hidden');
        $eyeClosed.toggleClass('hidden');
    });

    // Handle form submission dengan AJAX
    $loginForm.on('submit', function(e) {
        e.preventDefault();
        
        // Reset error messages
        resetErrors();
        hideAlert();
        
        // Show loading state
        setLoadingState(true);
        
        // Get form data
        const formData = new FormData(this);
        
        // AJAX request
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    
                    // Redirect setelah delay singkat
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1000);
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                
                if (xhr.status === 422) {
                    // Validation errors
                    showValidationErrors(response.errors);
                    showAlert(response.message || 'Terjadi kesalahan validasi', 'error');
                } else {
                    // Other errors
                    showAlert(response?.message || 'Terjadi kesalahan sistem', 'error');
                }
            },
            complete: function() {
                setLoadingState(false);
            }
        });
    });

    // Fungsi helper
    function resetErrors() {
        $('.border-red-500').removeClass('border-red-500');
        $('[id$="Error"]').addClass('hidden').text('');
    }

    function showValidationErrors(errors) {
        $.each(errors, function(field, messages) {
            const $field = $(`[name="${field}"]`);
            const $errorElement = $(`#${field}Error`);
            
            if ($field.length) {
                $field.addClass('border-red-500');
            }
            
            if ($errorElement.length) {
                $errorElement.removeClass('hidden').text(messages[0]);
            }
        });
    }

    function showAlert(message, type = 'info') {
        const bgColor = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 
                        type === 'error' ? 'bg-red-100 border-red-400 text-red-700' : 
                        'bg-blue-100 border-blue-400 text-blue-700';
        
        $alertMessage
            .removeClass('hidden bg-green-100 bg-red-100 bg-blue-100 border-green-400 border-red-400 border-blue-400 text-green-700 text-red-700 text-blue-700')
            .addClass(`${bgColor} border`)
            .text(message)
            .removeClass('hidden');
    }

    function hideAlert() {
        $alertMessage.addClass('hidden');
    }

    function setLoadingState(loading) {
        if (loading) {
            $loginButton.addClass('btn-loading').prop('disabled', true);
        } else {
            $loginButton.removeClass('btn-loading').prop('disabled', false);
        }
    }

    // Auto hide alert after 5 seconds
    $(document).on('click', function() {
        hideAlert();
    });
});
</script>
@endpush