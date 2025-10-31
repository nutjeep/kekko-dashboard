<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePasswordRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return auth()->check();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'current_password' => [
        'required',
        'string',
        'current_password'
      ],
      'new_password' => [
        'required',
        'string',
        'min:8',
        'confirmed', // Memastikan new_password_confirmation sama
        Password::min(8)
          // ->letters()
          // ->mixedCase()
          // ->numbers()
          // ->symbols()
          // ->uncompromised()
      ],
      'new_password_confirmation' => 'required|string|min:8'
    ];
  }

  public function messages()
  {
    return [
      'current_password.required' => 'Password wajib diisi',
      'new_password.min' => 'Password minimal 8 karakter',
      'new_password.confirmed' => 'Konfirmasi password tidak sesuai',
      'new_password.different' => 'Password baru harus berbeda dengan password lama',
      'new_password_confirmation.required' => 'Konfirmasi password baru wajib diisi',
    ];
  }

  public function attributes(): array
  {
    return [
      'current_password' => 'password saat ini',
      'new_password' => 'password baru',
      'new_password_confirmation' => 'konfirmasi password baru'
    ];
  }
}
