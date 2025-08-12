@extends('layouts.app')

@push('style')
   <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
   @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>{{ session('success') }}</strong>
         <button type="button" class="close btn-close-alert" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
   @endif
   @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <ul class="mb-0">
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
         </ul>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
         </button>
      </div>
   @endif

   <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between">
         <h6 class="m-0 font-weight-bold text-primary">Produk - Tema</h6>
         <button class="btn btn-primary" id="btn-create">
            <i class="fas fa-plus-circle mr-1"></i>
            Buat Baru
         </button>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Nama Tema</th>
                     <th>Created At</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>No</th>
                     <th>Nama Tema</th>
                     <th>Created At</th>
                     <th>Action</th>
                  </tr>
               </tfoot>
               <tbody>
                  @foreach ($themes as $theme)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $theme->name }}</td>
                        <td>{{ $theme->formatted_created_at }}</td>
                        <td>
                           <div style="display: flex; gap: 5px;">
                              <button type="button" id="btn-edit-theme" data-id="{{ $theme->id }}" class="btn btn-sm btn-warning">
                                 <i class="fas fa-edit"></i>
                              </button>
                           </div>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>

   {{-- MODAL CREATE --}}
   <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title font-weight-bold text-primary">Buat Tema</h5>
               <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
               </button>
            </div>
            <form action="{{ route('product_theme.store') }}" method="post">
               @csrf
               <div class="modal-body">
                  <div class="form-group">
                     <label for="name">Nama Tema</label>
                     <input type="text" class="form-control" name="name" id="name" required  oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                  </div>
               </div>
               <div class="modal-footer">
                  <button class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">
                     <i class="fas fa-save mr-1"></i>
                     Simpan
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>

   {{-- MODAL UPDATE --}}
   <div class="modal fade" id="editModal" data-id="" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title font-weight-bold text-primary">Edit Tema</h5>
               <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
               </button>
            </div>
            <form method="post">
               @csrf
               <div class="modal-body">
                  <div class="form-group">
                     <label for="name">Nama Tema</label>
                     <input type="text" class="form-control" name="name" id="modal_name" value="" required  oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">
                     <i class="fas fa-save mr-1"></i>
                     Simpan
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection

@push('script')
   <!-- Page level plugins -->
   <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

   <!-- Page level custom scripts -->
   <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

   <script>
      $(document).ready(function() {
         $('#btn-create').on('click', function() {
            $('#createModal').modal('show');
         });

         // === UPDATE THEME ===
         $(document).on('click', '#btn-edit-theme', function() {
            let theme_id = $(this).data('id');
            let url = "{{ route('product_theme.edit', [':theme_id']) }}";
               url = url.replace(':theme_id', theme_id);

            $.ajax({
               url: url,
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               type: 'GET',
               success: function(response) {
                  $('#editModal').find('#modal_name').val(response.name);
                  $('#editModal').data('id', response.id);
                  $('#editModal').modal('show');
               },
               error: function(error) {
                  alert('Gagal mengambil data order.');
                  console.error('error : ', error);
               }
            });
         });
      });

      // === UPDATE THEME ===
      $(document).on('submit', '#editModal form', function(e) {
         e.preventDefault();
         let url = "{{ route('product_theme.update', [':theme_id']) }}";
         url = url.replace(':theme_id', $('#editModal').data('id'));

         $.ajax({
            url: url, 
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
               $('#editModal').modal('hide');
               $('#editModal').find('#modal_name').val('');
               $('#editModal').find('#modal_name').focus();
               
               location.reload();
            },
            error: function(error) {
               alert('Gagal mengambil data order.');
               console.error('error : ', error);
            }
         });
      });
   </script>
@endpush