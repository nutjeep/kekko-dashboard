@extends('layouts.app')

@push('style')
   <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">Data Pesanan</h6>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Nama Pemesan</th>
                     <th>No. Telepon</th>
                     <th>Tipe Undangan</th>
                     <th>Tanggal Pesan</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>No</th>
                     <th>Nama Pemesan</th>
                     <th>No. Telepon</th>
                     <th>Tipe Undangan</th>
                     <th>Tanggal Pesan</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </tfoot>
               <tbody>
                  <tr>
                     <td>1</td>
                     <td>Humaidi Dahlah</td>
                     <td>08123456789</td>
                     <td style="display: flex; flex-direction: column; gap: 5px;">
                        <span class="btn btn-sm btn-info">
                           Undangan Cetak
                        </span>
                        <span class="btn btn-sm btn-warning">
                           Undangan Digital
                        </span>
                     </td>
                     <td>25 Jul 2025</td>
                     <td style="display: flex; flex-direction: column; gap: 5px;">
                        <span class="btn btn-sm btn-secondary">
                           Pending
                        </span>
                        <span class="btn btn-sm btn-info">
                           Pengerjaan
                        </span>
                        <span class="btn btn-sm btn-warning">
                           Ready to Check
                        </span>
                        <span class="btn btn-sm btn-success">
                           Selesai
                        </span>
                     </td>
                     <td>
                        <div style="display: flex; gap: 5px;">
                           <a href="#" class="btn btn-sm btn-primary">
                              <i class="fas fa-eye"></i>
                           </a>
                           <a href="{{ route('order.edit') }}" class="btn btn-sm btn-warning">
                              <i class="fas fa-edit"></i>
                           </a>
                           <a href="#" class="btn btn-sm btn-danger">
                              <i class="fas fa-trash"></i>
                           </a>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
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
@endpush