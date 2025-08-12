@extends('layouts.app')

@push('style')
   <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
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
                        <td>{{ $theme->created_at }}</td>
                        <td>
                           <div style="display: flex; gap: 5px;">
                              <button data-id="{{ $theme->id }}" class="btn btn-sm btn-warning">
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
@endsection

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
         <form action="" method="post">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="name">Nama Tema</label>
                  <input type="text" class="form-control" name="name" id="name" required>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>
               <button class="btn btn-primary" data-dismiss="modal">
                  <i class="fas fa-save mr-1"></i>
                  Simpan
               </button>
            </div>
         </form>
      </div>
   </div>
</div>

{{-- MODAL UPDATE --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title font-weight-bold text-primary">Buat Tema</h5>
            <button type="button" class="close" data-dismiss="modal">
               <span>&times;</span>
            </button>
         </div>
         <form action="" method="post">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="name">Nama Tema</label>
                  <input type="text" class="form-control" name="name" id="name" value="" required>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>
               <button class="btn btn-primary" data-dismiss="modal">
                  <i class="fas fa-save mr-1"></i>
                  Simpan
               </button>
            </div>
         </form>
      </div>
   </div>
</div>

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
      });
   </script>
@endpush