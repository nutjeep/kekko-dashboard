<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
    $userId = auth()->id();
    return [
      'name' => 'string|max:255',
      'username' => [
        'required',
        'string',
        'max:255',
        Rule::unique('users')->ignore($userId)
      ],
      'email' => [
        'nullable',
        'email',
        Rule::unique('users')->ignore(auth()->user()->email, 'email')
      ],
      'phone' => 'nullable|min:8'
    ];
  }
}
