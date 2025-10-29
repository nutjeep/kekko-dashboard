<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="M Najib Abdulloh | anajibmuhammad@gmail.com">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ env('APP_NAME') }}</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
  <!-- Custom styles for this template-->
  
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <style>
    label {
        font-size: 1rem;
        color: rgb(42, 42, 42);
    }
  </style>

  @stack('style')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
   <div id="wrapper">

      <!-- Sidebar -->
      @include('components.sidebar')
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

         <!-- Main Content -->
         <main id="content">

               <!-- Topbar -->
               @include('components.topbar')
               <!-- End of Topbar -->

               <!-- Begin Page Content -->
               <div class="container-fluid">

                  @if (isset($back_button) && $back_button)
                     <a href="{{ $back_button_route }}" class="btn btn-secondary mb-3">
                        <i class="fas fa-arrow-left"></i>
                        Back
                     </a>
                  @endif

                  <section>
                     @yield('content')
                  </section>

               </div>
               <!-- /.container-fluid -->

         </main>
         <!-- End of Main Content -->

         <!-- Footer -->
         {{-- <footer class="sticky-footer bg-white">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright &copy; Your Website 2021</span>
                  </div>
               </div>
         </footer> --}}
         <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
   </a>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="login.html">Logout</a>
               </div>
         </div>
      </div>
   </div>

   <!-- Bootstrap core JavaScript-->
   <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
   <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

   <!-- Core plugin JavaScript-->
   <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

   <!-- Custom scripts for all pages-->
   <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

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