@extends('layouts.app')

@push('style')
   <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
   <style>
      p.label {
         font-size: 1rem;
         color: rgb(42, 42, 42);
         display: inline-block;
         margin-bottom: .5rem;
      }
   </style>
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
                     <th>Pegawai</th>
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
                     <th>Pegawai</th>
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
                        <td>{{ $order->user_name }}</td>
                        <td style="display:flex; flex-direction:column; gap:5px;">
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
                           @elseif($order->status == 'done')
                              <span class="btn btn-sm btn-danger">
                                 Canceled
                              </span>
                           @else
                              -
                           @endif
                        </td>
                        <td>
                           <div style="display: flex; gap: 5px;">
                              <a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-warning">
                                 <i class="fas fa-edit"></i>
                              </a>
                              <button class="btn btn-sm btn-primary btn-show-order" data-id="{{ $order->id }}">
                                 <i class="fas fa-arrow-right"></i>
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

{{-- MODAL --}}
{{-- <div class="modal fade" id="orderModal-{{ $order->id }}" tabindex="-1" aria-labelledby="orderModal-{{ $order->id }}Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> --}}

<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <div class="flex flex-row">
               <h5 class="modal-title font-weight-bold text-primary">Detail Order</h5>
               <small class="text-secondary text-sm" id="modal_order_id"></small>
            </div>
            <button type="button" class="close" data-dismiss="modal">
               <span>&times;</span>
            </button>
         </div>
         <form action="{{ route('transaction.store') }}" method="post">
            @csrf
            <input type="hidden" name="trx_from" value="order">
            <div class="modal-body">
               <div class="row mb-3">
                  <div class="col-lg-6">
                     <label for="employee_id">Pegawai</label>
                     <select name="employee_id" id="employee_id" class="form-control">
                        <option value="" disabled selected>Pilih Pegawai</option>
                        @foreach ($employees as $employee)
                           <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-lg-6">
                     <label for="modal_customer_phone">Status Order</label>
                     <select name="order_status" id="status" class="form-control">
                        <option value="" disabled selected>Pilih Status</option>
                        @foreach ($statuses as $status => $lable)
                           <option value="{{ $status }}">{{ $lable }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-lg-6">
                     <label for="modal_customer_name">Nama Pemesan</label>
                     <input type="text" class="form-control" name="modal_customer_name" id="modal_customer_name" value="" aria-label="Customer Name" aria-describedby="customer_name" disabled>
                  </div>
                  <div class="col-lg-6">
                     <label for="modal_customer_phone">No. Telepon</label>
                     <input type="text" class="form-control" name="modal_customer_phone" id="modal_customer_phone" value="" aria-label="Customer Phone" aria-describedby="customer_phone" disabled>
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-lg-6">
                     <label for="order_date">Tanggal Pesan</label>
                     <input type="date" class="form-control" name="order_date" id="order_date" value="" disabled>
                  </div>
                  <div class="col-lg-6">
                     <label for="order_due_date">Batas Waktu</label>
                     <input type="date" class="form-control" name="order_due_date" id="order_due_date" value="">
                  </div>
               </div>

               <hr class="my-3">

               <h6 class="h6 font-weight-bold text-dark">Undangan Digital</h6>
               <div class="row mb-3 digital_invitation_section">
                  <div class="col-lg-6">
                     <p class="label">Produk</p>
                     <br>
                     <span class="h6 text-primary" id="modal_digital_name"></span>
                  </div>
                  <div class="col-lg-4">
                     <label for="order_digital_price text-primary">Harga</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text bg-primary text-white" id="order_digital_price">Rp: </span>
                        </div>
                        <input type="text" class="form-control" name="order_digital_price" aria-label="order_digital_price" aria-describedby="order_digital_price" oninput="this.value = this.value.replace(/[^\d.]/g, '')">
                     </div>
                  </div>
               </div>

               <h6 class="h6 mt-4 font-weight-bold text-dark">Undangan Cetak</h6>
               <div class="row printed_invitation_section">
                  <div class="col-lg-4">
                     <p class="label">Tipe Undangan</p>
                     <br>
                     <span class="text-primary" id="modal_printed_type"></span>
                  </div>
                  <div class="col-lg-2">
                     <label for="order_printed_quantity">Jumlah</label>
                     <input type="text" class="form-control" name="order_printed_quantity" id="order_printed_quantity">
                  </div>
                  <div class="col-lg-4">
                     <label for="order_printed_price">Total Harga: </label>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <span class="input-group-text bg-primary text-white" id="order_printed_price">Rp: </span>
                        </div>
                        <input type="text" class="form-control" name="order_printed_price" aria-label="order_printed_price" aria-describedby="order_printed_price" oninput="this.value = this.value.replace(/[^\d.]/g, '')">
                     </div>
                  </div>
               </div>
               
               <h6 class="h6 font-weight-bold text-dark">Addons</h6>
               <div class="addons_section">
                  <div class="row mb-2" id="addons-1">
                     <div class="col-lg-6">
                        <div class="form-group mb-3">
                           <label for="order_addon_1_name">Nama</label>
                           <input type="text" class="form-control" name="order_addon_1_name" aria-label="order_addon_1_name" aria-describedby="order_addon_1_name">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <label for="order_addon_1_price">Harga: </label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text bg-primary text-white" id="order_addon_1_price">Rp</span>
                           </div>
                           <input type="text" id="order_addon_1_price" class="form-control" name="order_addon_1_price" aria-label="order_addon_1_price" aria-describedby="order_addon_1_price" oninput="this.value = this.value.replace(/[^\d.]/g, '')">
                        </div>
                     </div>
                     {{-- <div class="col-lg-1">
                        <button class="btn btn-primary" type="button" id="add-addons">
                           <i class="fas fa-plus-circle"></i>
                        </button>
                     </div> --}}
                  </div>
               </div>

               <div class="total_section">
                  <h5 class="text-dark h4 font-weight-bold">Grand Total :</h5>
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text bg-primary text-white font-weight-bold" id="total_price">Rp</span>
                     </div>
                     <input type="text" id="total_price" class="form-control" name="total_price" aria-label="total_price" aria-describedby="total_price" readonly>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger mr-1" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">
                  Proses Transaksi
                  <i class="fas fa-arrow-right"></i>
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
         $(document).on('click', '.btn-show-order', function() {
            let order_id = $(this).data('id');
            let url = "{{ route('order.get_by_id', [':order_id']) }}";
               url = url.replace(':order_id', order_id);

            $.ajax({
               url: url,
               type: 'GET',
               success: function(response) {
                  // console.log('response : ', response);
                  const created_at = new Date(response.created_at);
                  const formatted_date = created_at.toISOString().split('T')[0];
                  
                  $('#modal_order_id').text(response.order_id);
                  $('#modal_customer_name').val(response.customer_name);
                  $('#modal_customer_phone').val(response.customer_phone);
                  $('#modal_digital_name').text(response.order_information.digital_invitation.name ?? '-');
                  $('#modal_printed_type').text(response.order_information.printed_invitation.type ?? '-');
                  $('input[name="order_date"]').val(formatted_date);
                  $('#employee_id').val(response.user_id);
                  $('#status').val(response.status);

                  $('#orderModal').modal('show');
               },
               error: function(error) {
                  alert('Gagal mengambil data order.');
                  console.error('error : ', error);
               }
            });
         });

         // === CALCULATE TOTAL PRICE ===
         // Fungsi untuk memformat angka ke format mata uang
         function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
         }

         // Fungsi untuk menghapus format mata uang dan mengembalikan angka
         function unformatNumber(str) {
            return parseFloat(str.replace(/,/g, '')) || 0;
         }

         // Calculate Total Price
         function calculateTotal() {
            let digitalPrice = unformatNumber($('input[name="order_digital_price"]').val());
            let printedPrice = unformatNumber($('input[name="order_printed_price"]').val());
            let addonPrice = unformatNumber($('input[name="order_addon_1_price"]').val());

            let total = digitalPrice + printedPrice + addonPrice;

            $('input[name="total_price"]').val(formatNumber(total));
         }
         
         $('input[name="order_digital_price"], input[name="order_printed_price"], input[name="order_addon_1_price"]').on('input', function() {
            let value = $(this).val();
            let unformatted = unformatNumber(value);
            $(this).val(formatNumber(unformatted));
            
            calculateTotal();
         });

         calculateTotal();
      });
   </script>
@endpush