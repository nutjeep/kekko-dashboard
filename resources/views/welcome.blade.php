@extends('layouts.app_welcome')

@section('content')
  <header class="w-full p-4 md:p-6 flex justify-end z-10">
    <a href="{{ route('login') }}" class="
      px-4 py-2 
      bg-[#4e73df] 
      text-white 
      font-semibold 
      rounded-lg 
      shadow-lg 
      hover:bg-blue-700 
      transition 
      duration-300 
      ease-in-out
      border border-[#4e73df]
      transform hover:scale-105
      focus:outline-none focus:ring-2 focus:ring-[#4e73df] focus:ring-opacity-50
      text-sm md:text-base
    ">
      Login Here
    </a>
  </header>

  <!-- Konten Utama (Minimalis dan Estetik) -->
  <main class="flex-grow flex items-center justify-center p-4">
    <!-- Menggunakan border biru muda untuk kartu -->
    <div class="text-center max-w-xl p-8 md:p-12 bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl border border-blue-200">
      <div class="mb-8 text-[#4e73df] flex items-center justify-center">
        <img class="h-16 w-auto" src="{{ asset('img/logo-kekko.png') }}" alt="">
      </div>
      <h1 class="font-headline text-5xl sm:text-6xl md:text-7xl font-light tracking-wide text-[#4e73df] mb-4">
        Kekko
      </h1>

      <p class="font-headline text-2xl sm:text-3xl font-normal italic text-gray-600 mb-6">
        Invitation
      </p>

      <p class="font-body text-sm md:text-base text-gray-500 max-w-xs mx-auto">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni, consequuntur.
      </p>
    </div>
  </main>
@endsection