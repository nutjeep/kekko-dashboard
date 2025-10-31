<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function index ()
  {
    $title = 'Login';
    return view('pages.auth.login', compact('title'));
  }

  public function loginAction(Request $request)
  {
    try {
      // Validasi input
      $credentials = $request->validate([
          'username' => 'required|string',
          'password' => 'required|string|min:6'
      ], [
          'username.required' => 'Username wajib diisi',
          'password.required' => 'Password wajib diisi',
          'password.min' => 'Password minimal 6 karakter'
      ]);

      // Coba login dengan username/email
      $loginType = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
      
      $loginData = [
          $loginType => $credentials['username'],
          'password' => $credentials['password']
      ];

      if (Auth::attempt($loginData, $request->boolean('remember'))) {
        $request->session()->regenerate();
        
        return response()->json([
          'success' => true,
          'message' => 'Login berhasil!',
          'redirect' => route('dashboard')
        ]);
      }

      // Jika autentikasi gagal
      throw ValidationException::withMessages([
        'username' => ['Username atau password salah.'],
      ]);
    }
    catch (ValidationException $e) {
      return response()->json([
        'success' => false,
        'message' => 'Terjadi kesalahan validasi',
        'errors' => $e->errors()
      ], 422);

    }
    catch (\Exception $e) {
      Log::error('Login error: ' . $e->getMessage());
        
      return response()->json([
          'success' => false,
          'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
      ], 500);
    }
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Jika request AJAX, return JSON response
    if ($request->expectsJson()) {
      return response()->json([
        'success' => true,
        'message' => 'Logout berhasil',
        'redirect' => route('login')
      ]);
    }

    return redirect()->route('login');
  }
}
