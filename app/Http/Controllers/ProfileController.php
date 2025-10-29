<?php

namespace App\Http\Controllers;

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
    // $user = Auth::user();
    // $profile = $this->profile->getProfile($user->id);
    $profile = User::where('id', 2)->first();

    return view('pages.profile.index', compact('profile'));
  }

  public function update (UpdateProfileRequest $request, $id)
  {
    try {
      DB::beginTransaction();

      $validatedData = $request->validated();
      $this->profile->update($id, $validatedData);

      DB::commit();
      return redirect()->back()->with('success', 'Berhasil update profil');
    }
    catch (ValidationException $e)
    {
      DB::rollBack();
      Log::error("Error Update Profile: " . $e->validator->errors());
      return back()->withErrors($e->validator)->withInput();
    }
  }
}
