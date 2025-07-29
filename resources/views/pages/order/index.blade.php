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
                  @foreach ($orders as $order)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_phone }}</td>
                        <td style="display: flex; flex-direction: column; gap: 5px;">
                           @if ($order->order_information['invitation_type'] == 'printed_invitation')
                              <span class="btn btn-sm btn-info">
                                 Undangan Cetak
                              </span>
                           @elseif ($order->order_information['invitation_type'] == 'digital_invitation')
                              <span class="btn btn-sm btn-warning">
                                 Undangan Digital
                              </span>
                           @elseif ($order->order_information['invitation_type'] == 'printed_digital')
                              <span class="btn btn-sm btn-danger">
                                 Digital & Cetak
                              </span>
                           @endif
                        </td>
                        <td>{{ $order->formatted_created_at }}</td>
                        <td style="display: flex; flex-direction: column; gap: 5px;">
                           @if ($order->status == 'pending')
                              <span class="btn btn-sm btn-secondary">
                                 Pending
                              </span>
                           @elseif($order->status == 'on progress')
                              <span class="btn btn-sm btn-info">
                                 On Progress
                              </span>
                           @elseif($order->status == 'ready to check')
                              <span class="btn btn-sm btn-warning">
                                 Ready to Check
                              </span>
                           @elseif($order->status == 'done')
                              <span class="btn btn-sm btn-success">
                                 Completed
                              </span>
                           @endif
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
                  @endforeach
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