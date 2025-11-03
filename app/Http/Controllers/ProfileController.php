<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfilePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProfileRepository;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
  protected $profile;

  public function __construct(ProfileRepository $profileRepository)
  {
    $this->profile = $profileRepository;
  }

  public function index ()
  {
    $profile = Auth::user();

    return view('pages.profile.index', compact('profile'));
  }

  public function update (UpdateProfileRequest $request)
  {
    try {
      DB::beginTransaction();

      $validatedData = $request->validated();
      $userId = Auth::id();
      $this->profile->update($userId, $validatedData);

      DB::commit();
      return response()->json([
        'success' => true,
        'message' => 'Berhasil update',
        'redirect' => route('profile')
      ]);
    }
    catch (ValidationException $e)
    {
      DB::rollBack();
      Log::error("Error Update Profile: " . $e->validator->errors());
      return response()->json([
        'success' => false,
        'message' => $e->validator->errors(),
        'redirect' => back()
      ]);
      // return back()->withErrors($e->validator)->withInput();
    }
  }

  public function password ()
  {
    $profile = User::where('id', 2)->first();

    return view('pages.profile.change_password.index', compact('profile'));
  }

  public function updatePassword (UpdateProfilePasswordRequest $request)
  {
    try {
      DB::beginTransaction();

      $validatedData = $request->validated();
      $userId = Auth::id();
      $this->profile->updatePassword($userId, $validatedData['new_password']);

      DB::commit();
      return redirect()->back()->with('success', 'Berhasil update password');
    }
    catch (ValidationException $e) {
      DB::rollBack();
      Log::error("Error Update Password: " . $e->validator->errors());
      return back()->withErrors($e->validator)->withInput();
    }
  }
}
