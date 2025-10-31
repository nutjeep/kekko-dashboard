<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Inter:wght@100..900&display=swap');
      
      .font-headline {
        font-family: 'Playfair Display', serif;
      }
      .font-body {
        font-family: 'Inter', sans-serif;
      }
      
      .elegant-bg {
        background: linear-gradient(135deg, #f0f8ff 0%, #f5faff 100%); /* AliceBlue to very light Sky Blue */
      }
    </style>

    @stack('style')
  </head>
  <body class="font-body antialiased min-h-screen flex flex-col elegant-bg text-gray-800">
    @yield('content')
  </body>
  @stack('script')
</html>