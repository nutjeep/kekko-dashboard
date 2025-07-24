<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <style>
    * {
      color: black;
    }
  </style>
  @stack('style')
  <title>Kekko | Data Pesanan</title>
</head>
<body>
  <main class="container py-3">
    @yield('content')
  </main>

  @stack('script')
  <script>
    $(document).ready(function() {
    // Temukan semua elemen input yang memiliki atribut required
    $('input[required], select[required], textarea[required]').each(function() {
      // Dapatkan id dari elemen input
      var inputId = $(this).attr('id');
      
      // Temukan label yang memiliki atribut for yang sesuai dengan id input
      $('label[for="' + inputId + '"]').each(function() {
        // Tambahkan span dengan tanda bintang setelah teks label
        $(this).append('<span class="text-danger"> *</span>');
      });
    });
  });
  </script>
</body>
</html>