<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperadminMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    try {
      if (!Auth::check()) {
        Log::warning('Unauthorized access attempt', [
          'ip' => $request->ip(),
          'url' => $request->fullUrl()
        ]);
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
      }

      $user = Auth::user();
      
      // Load role jika belum diload (prevent N+1)
      if (!$user->relationLoaded('role')) {
        $user->load('role');
      }

      if (!$user->isSuperadmin()) {
        Log::warning('Superadmin access denied', [
          'user_id' => $user->id,
          'role' => $user->role?->name,
          'ip' => $request->ip(),
          'url' => $request->fullUrl()
        ]);
        
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
      }

      return $next($request);
    }
    catch (\Exception $e) {
      Log::error('Superadmin middleware error: ' . $e->getMessage());
      return redirect()->route('login')->with('error', 'Terjadi kesalahan sistem.');
    }
  }
}
