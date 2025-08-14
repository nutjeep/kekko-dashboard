@extends('layouts.app')

@push('style')
   <style>
      hr {
         background-color: rgba(0, 0, 0, 0.3);
         height: .2px;
      }
      h2, h3 {
         color: rgb(73, 73, 73);
      }
   </style>
@endpush

@section('content')
   @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>{{ session('success') }}</strong>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
   
   <form action="{{ route('order.update', $order->id) }}" method="post">
      @csrf
      @method('PUT')
      <div class="card shadow mb-3">
         <div class="card-header">
            <h2 class="m-0 font-weight-bold text-primary h4">Data Pemesan</h2>
         </div>
         <div class="card-body p-3">
            <div class="row">
               <div class="col-lg-3">
                  <div class="form-group">
                     <label for="status">Status</label>
                     <select name="status" id="status" class="form-control">
                        @foreach ($statuses as $status => $lable)
                           <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ $lable }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-lg-3">
                  <div class="form-group">
                     <label for="user_id">Pegawai</label>
                     <select name="user_id" id="user_id" class="form-control">
                        @foreach ($employees as $employee)
                           @if ($employee->id == $order->user_id)
                              <option value="{{ $employee->id }}" selected>{{ $employee->name }}</option>
                           @else
                              <option value="" selected disabled>Pilih Pegawai</option>
                              <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                              <option value="">None</option>
                           @endif
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>
            
            <div class="row mb-3">
               <div class="col-lg-6">
                  <div class="form-group mb-2">
                     <label for="customer_name">Nama Pemesan</label>
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" id="customer_name" aria-label="Recipient's username" aria-describedby="customer_name" >
                        <div class="input-group-append">
                           <button class="input-group-text" id="customer_name">copy</button>
                        </div>
                     </div>
                  </div>
                  <div class="form-group mb-2">
                     <label for="order_date">Tanggal Pesan</label>
                     <input type="date" class="form-control" name="order_date" id="order_date" value="" disabled>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="form-group mb-2">
                     <label for="customer_phone">No Whatsapp</label>
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" name="customer_phone" value="{{ old('customer_phone', $order->customer_phone) }}" id="customer_phone" aria-label="Recipient's username" aria-describedby="customer_phone" oninput="this.value = this.value.replace(/[^\d.]/g, '')">
                        <div class="input-group-append">
                           <button class="input-group-text" id="customer_phone">copy</button>
                        </div>
                     </div>
                  </div>
                  <div class="form-group mb-2">
                     <label for="due_date">Batas Waktu</label>
                     <input type="date" class="form-control" name="due_date" id="due_date" value="">
                  </div>
               </div>
            </div>

            <hr>

            <div class="row">
               <div class="col-lg-4" id="invitation_type">
                  <h3 class="h5 font-weight-bold">Nama Yang Didahulukan</h3>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="first_come" id="first_come_groom" value="groom" @if($order->order_information['first_come'] == 'groom') checked @endif>
                     <label class="form-check-label" for="first_come_groom">
                        Pria
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="first_come" id="first_come_bride" value="bride" @if($order->order_information['first_come'] == 'bride') checked @endif>
                     <label class="form-check-label" for="first_come_bride">
                        Wanita
                     </label>
                  </div>
               </div>
               <div class="col-lg-4">
                  <h3 class="h5  font-weight-bold">Tipe Undangan</h3>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="invitation_type" id="printed_invitation" value="printed_invitation" @if($order->order_information['invitation_type'] == 'printed_invitation') checked @endif>
                     <label class="form-check-label" for="printed_invitation">
                        Cetak
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="invitation_type" id="digital_invitation" value="digital_invitation" @if($order->order_information['invitation_type'] == 'digital_invitation') checked @endif>
                     <label class="form-check-label" for="digital_invitation">
                        Digital
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="invitation_type" id="printed_digital" value="printed_digital" @if($order->order_information['invitation_type'] == 'printed_digital') checked @endif>
                     <label class="form-check-label" for="printed_digital">
                        Cetak & Digital
                     </label>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="mb-3" id="printed_invitation_section">
                     <h3 class="h5  font-weight-bold">Undangan Cetak</h3>
                     <div class="form-group mb-3">
                        <label for="printed_name">Tipe Undangan</label>
                        <input id="printed_name" name="printed_name" type="text" class="form-control" placeholder="Ex: Tipe Zigna Mooi Lite" value="{{ $order->order_information['printed_invitation']['name'] }}">
                        <small>Katalog : <a target="_blank" href="https://wa.me/c/6285730739878">Klik Disini</a></small>
                     </div>
                     <div class="form-group">
                        <label for="printed_quantity" class="font-weight-bold text-primary">Jumlah</label>
                        <input type="text" id="printed_quantity" name="printed_quantity" inputmode="numeric" class="form-control" placeholder="Ex: 100" value="{{ $order->order_information['printed_invitation']['quantity'] }}">
                     </div>
                     <div class="form-group">
                        <label for="printed_price" class="text-primary font-weight-bold">Harga</label>
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text bg-primary text-white" id="printed_price">Rp: </span>
                           </div>
                           <input type="text" id="printed_price" class="form-control" name="printed_price" inputmode="numeric" 
                              value="{{ old('printed_price', $order->order_information['printed_invitation']['price']) == 0 ? '' : $order->order_information['printed_invitation']['price'] }}" 
                              oninput="let value = this.value.replace(/[^\d.]/g, ''); //only numeric
                                 this.value = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'); //format ribuan" 
                           >
                        </div>
                     </div>
                  </div>

                  <div class="mb-3" id="digital_invitation_section">
                     <h3 class="h5 font-weight-bold">Undangan Digital</h3>
                     <div class="form-group mb-3">
                        <label for="digital_id">Tema Undangan</label>
                        <select id="digital_id" name="digital_id" class="form-control">
                           <option value="" disabled>Pilih Produk</option>
                           @foreach ($product_digital_invitations as $digital)
                              @if ($digital->id == $order->order_information['digital_invitation']['id'])
                                 <option value="{{ $digital->id }}" selected>{{ $digital->name }} | {{ $digital->product_package_name }}</option>
                              @else
                                 <option value="{{ $digital->id }}">{{ $digital->name }} | {{ $digital->product_package_name }}</option>
                              @endif
                           @endforeach
                        </select>
                        <small>Katalog : <a target="_blank" href="https://kekkoinvitation.com/">Klik Disini</a></small>
                     </div>
                     <div class="form-group">
                        <label for="digital_price" class="text-primary font-weight-bold">Harga</label>
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text bg-primary text-white" id="digital_price">Rp: </span>
                           </div>
                           <input type="text" id="digital_price" class="form-control" name="digital_price" 
                              inputmode="numeric"
                              value="{{ old('digital_price', $order->order_information['digital_invitation']['price']) == 0 ? '' : $order->order_information['digital_invitation']['price'] }}" 
                              oninput="let value = this.value.replace(/[^\d.]/g, ''); 
                                 this.value = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');"
                           >
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row mb-3">
               <div class="col-lg-12">
                  <h3 class="h5 font-weight-bold">Addons</h3>
                  <div style="display: flex; gap: 10px;">
                     <div class="form-group" style="width: 33%;">
                        <label for="addon_1_name">Nama</label>
                        <textarea id="addon_1_name" class="form-control" rows="3" name="addon_1_name">{{ $order->addons['addon_1']['name'] }}</textarea>
                     </div>
                     <div class="form-group">
                        <label for="addon_1_name">Harga</label>
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text bg-primary text-white" id="addon_1_price">Rp: </span>
                           </div>
                           <input type="text" id="addon_1_price" class="form-control" name="addon_1_price" inputmode="numeric" 
                              value="{{ old('addon_1_price', $order->addons['addon_1']['price']) == 0 ? '' : $order->addons['addon_1']['price'] }}" 
                              oninput="let value = this.value.replace(/[^\d.]/g, ''); //only numeric
                                 this.value = value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'); //format ribuan" 
                           >
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="total_section row">
               <div class="col-lg-12">
                  <h5 class="text-dark h4 font-weight-bold">Grand Total :</h5>
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text bg-primary text-white font-weight-bold" id="total_price">Rp</span>
                     </div>
                     <input type="text" id="total_price" class="form-control" value="" name="total_price" aria-label="total_price" aria-describedby="total_price" readonly>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="card shadow p-3 mb-3" id="data-pengantin">
         <div class="row mb-2">
            <div class="col-lg-6 px-3" id="groom">
               <h2 class="font-weight-bold text-primary h4">Data Mempelai Pria</h2>
               <div class="form-group mb-3">
                  <label for="groom_name">Nama Lengkap</label>
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" id="groom_name" name="groom_name" value="{{ old('groom_name', $order->groom_bride_data['groom']['name']) }}" aria-label="Recipient's username" aria-describedby="groom_name" >
                     <div class="input-group-append">
                        <button class="input-group-text" id="groom_name">copy</button>
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="groom_nickname">Nama Panggilan</label>
                  <div class="input-group mb-3">
                     <input type="text" name="groom_nickname" value="{{ old('groom_nickname', $order->groom_bride_data['groom']['nickname']) }}" class="form-control" id="groom_nickname" aria-label="Recipient's username" aria-describedby="groom_nickname" >
                     <div class="input-group-append">
                        <button class="input-group-text" id="groom_nickname">copy</button>
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="groom_father_name">Nama Ayah</label>
                  <div class="input-group mb-3">
                     <input type="text" name="groom_father_name" value="{{ old('groom_father_name', $order->groom_bride_data['groom']['father_name']) }}" class="form-control" id="groom_father_name" aria-label="Recipient's username" aria-describedby="groom_father_name" >
                     <div class="input-group-append">
                        <button class="input-group-text" id="groom_father_name">copy</button>
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="groom_mother_name">Nama Ibu</label>
                  <div class="input-group mb-3">
                     <input type="text" name="groom_mother_name" value="{{ old('groom_mother_name', $order->groom_bride_data['groom']['mother_name']) }}" class="form-control" id="groom_mother_name" aria-label="Recipient's username" aria-describedby="groom_mother_name" >
                     <div class="input-group-append">
                        <button class="input-group-text" id="groom_mother_name">copy</button>
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="groom_number_child">Urutan Anak Dalam Keluarga</label>
                  <div class="input-group mb-3">
                     <input type="text" name="groom_number_child" value="{{ old('groom_number_child', $order->groom_bride_data['groom']['number_child']) }}" class="form-control" id="groom_number_child" aria-label="Recipient's username" aria-describedby="groom_number_child" >
                     <div class="input-group-append">
                        <button class="input-group-text" id="groom_number_child">copy</button>
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="groom_address">Alamat Lengkap</label>
                  <textarea id="groom_address" class="form-control mb-2" rows="3" name="groom_address">{{ $order->groom_bride_data['groom']['address'] }}</textarea>
                  <div style="width:100%; justify-items: right;">
                     <button class="input-group-text" id="groom_address">copy address</button>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="groom_phone">No. Whatsapp</label>
                  <div class="input-group mb-3">
                     <input type="text" name="groom_phone" value="{{ old('groom_phone', $order->groom_bride_data['groom']['phone']) }}" class="form-control" id="groom_phone" placeholder="No Whatsapp" aria-label="Whatsapp" aria-describedby="groom_phone">
                     <div class="input-group-append">
                        <button class="input-group-text" id="groom_phone">copy</button>
                     </div>
                  </div>
               </div>
               <div class="mb-3">
                  <label for="groom_instagram">Akun Instagram</label>
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                     </div>
                     <input type="text" name="groom_instagram" value="{{ old('groom_instagram', $order->groom_bride_data['groom']['instagram']) }}" id="groom_instagram" class="form-control c" aria-label="Groom Instagram" oninput="this.value = this.value.replace(/\s+/g, '').toLowerCase();">
                     <div class="input-group-append">
                        <button class="input-group-text" id="groom_instagram">copy</button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6 px-3" id="bride">
               <h2 class="font-weight-bold text-primary h4">Data Mempelai Wanita</h2>
               <div class="form-group mb-3">
                  <label for="bride_name">Nama Lengkap</label>
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" id="bride_name" name="bride_name" value="{{ old('bride_name', $order->groom_bride_data['bride']['name']) }}" aria-label="Recipient's username" aria-describedby="bride_name" >
                     <div class="input-group-append">
                        <button class="input-group-text" id="bride_name">copy</button>
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="bride_nickname">Nama Panggilan</label>
                  <div class="input-group mb-3">
                     <input type="text" name="bride_nickname" value="{{ old('bride_nickname', $order->groom_bride_data['bride']['nickname']) }}" class="form-control" id="bride_nickname" aria-label="Recipient's username" aria-describedby="bride_nickname" >
                     <div class="input-group-append">
                        <button class="input-group-text" id="bride_nickname">copy</button>
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="bride_father_name">Nama Ayah</label>
                  <div class="input-group mb-3">
                     <input type="text" name="bride_father_name" value="{{ old('bride_father_name', $order->groom_bride_data['bride']['father_name']) }}" class="form-control" id="bride_father_name" aria-label="Recipient's username" aria-describedby="bride_father_name" >
                     <div class="input-group-append">
                        <button class="input-group-text" id="bride_father_name">copy</button>
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="bride_mother_name">Nama Ibu</label>
                  <div class="input-group mb-3">
                     <input type="text" name="bride_mother_name" value="{{ old('bride_mother_name', $order->groom_bride_data['bride']['mother_name']) }}" class="form-control" id="bride_mother_name" aria-label="Recipient's username" aria-describedby="bride_mother_name" >
                     <div class="input-group-append">
                        <button class="input-group-text" id="bride_mother_name">copy</button>
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="bride_number_child">Urutan Anak Dalam Keluarga</label>
                  <div class="input-group mb-3">
                     <input type="text" name="bride_number_child" value="{{ old('bride_number_child', $order->groom_bride_data['bride']['number_child']) }}" class="form-control" id="bride_number_child" aria-label="Recipient's username" aria-describedby="bride_number_child" >
                     <div class="input-group-append">
                        <button class="input-group-text" id="bride_number_child">copy</button>
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="bride_address">Alamat Lengkap</label>
                  <textarea id="bride_address" class="form-control mb-2" rows="3" name="bride_address">{{ $order->groom_bride_data['bride']['address'] }}</textarea>
                  <div style="width:100%; justify-items: right;">
                     <button class="input-group-text" id="bride_address">copy address</button>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <label for="bride_phone">No. Whatsapp</label>
                  <div class="input-group mb-3">
                     <input type="text" name="bride_phone" value="{{ old('bride_phone', $order->groom_bride_data['bride']['phone']) }}" class="form-control" id="bride_phone" aria-label="Recipient's username" aria-describedby="bride_phone">
                     <div class="input-group-append">
                        <button class="input-group-text" id="bride_phone">copy</button>
                     </div>
                  </div>
               </div>
               <div class="mb-3">
                  <label for="bride_instagram">Akun Instagram</label>
                  <div class="input-group mb-3">
                     <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                     </div>
                     <input type="text" name="bride_instagram" value="{{ old('bride_instagram', $order->groom_bride_data['bride']['instagram']) }}" id="bride_instagram" class="form-control" aria-label="Amount (to the nearest dollar)" oninput="this.value = this.value.replace(/\s+/g, '').toLowerCase();">
                     <div class="input-group-append">
                        <button class="input-group-text" id="bride_instagram">copy</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="others">
            <h2 class="font-weight-bold text-primary h4">Lain - Lain</h2>
            <div class="form-group mb-3">
               <label for="link_gdrive">Link Gdrive Foto / Video</label>
               <input type="text" name="link_gdrive" value="{{ old('link_gdrive', $order->groom_bride_data['others']['link_gdrive']) }}" id="link_gdrive" class="form-control">
            </div>
            <div class="form-group mb-3">
               <label for="backsound_music">Backsound Musik</label>
               <input type="text" name="backsound_music" value="{{ old('backsound_music', $order->groom_bride_data['others']['backsound_music']) }}" id="backsound_music" class="form-control">
            </div>
            <div class="form-group mb-3">
               <label for="notes">Catatan Tambahan</label>
               <textarea id="notes" class="form-control" name="notes" rows="5">{{ $order->groom_bride_data['others']['notes'] }}</textarea>
            </div>
         </div>
      </div>

      <div class="card shadow">
         <div class="card-header">
            <h2 class="font-weight-bold text-primary h4">Acara</h2>
         </div>
         <div class="card-body p-3">
            <div class="row">
               <div class="col-lg-4">
                  <h3 class="h5  font-weight-bold">Akad Nikah</h3>
                  <div class="form-group mb-3">
                     <label for="akad_date">Tanggal</label>
                     <input type="date" id="akad_date" class="form-control" name="akad_date" value="{{ old('akad_date', $order->agenda_data['akad']['date']) }}">
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="akad_time_start">Waktu Mulai</label>
                           <input type="time" id="akad_time_start" class="form-control" name="akad_time_start" value="{{ old('akad_time_start', $order->agenda_data['akad']['time_start']) }}">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="akad_time_end">Waktu Selesai</label>
                           <input type="time" id="akad_time_end" class="form-control" name="akad_time_end" value="{{ old('akad_time_end', $order->agenda_data['akad']['time_end']) }}">
                        </div>
                     </div>
                  </div>
                  <div class="form-group mb-3">
                     <label for="akad_place">Tempat</label>
                     <div class="input-group mb-3">
                        <input type="text" name="akad_place" value="{{ old('akad_place', $order->agenda_data['akad']['place']) }}" class="form-control" id="akad_place" aria-label="Recipient's username" aria-describedby="akad_place">
                        <div class="input-group-append">
                           <button class="input-group-text" id="akad_place">copy</button>
                        </div>
                     </div>
                  </div>
                  <div class="form-group mb-3">
                     <label for="">Link Google Map</label>
                     <div class="input-group mb-3">
                        <input type="text" name="akad_maps" value="{{ old('akad_maps', $order->agenda_data['akad']['maps']) }}" class="form-control" id="akad_maps" aria-label="Recipient's username" aria-describedby="akad_maps">
                        <div class="input-group-append">
                           <button class="input-group-text" id="akad_maps">copy</button>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-lg-4">
                  <h3 class="h5  font-weight-bold">Resepsi Pernikahan</h3>
                  <div class="form-group mb-3">
                     <label for="resepsi_date">Tanggal</label>
                     <input type="date" id="resepsi_date" class="form-control" name="resepsi_date" value="{{ old('resepsi_date', $order->agenda_data['resepsi']['date']) }}">
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="resepsi_time_start">Waktu Mulai</label>
                           <input type="time" id="resepsi_time_start" class="form-control" name="resepsi_time_start" value="{{ old('resepsi_time_start', $order->agenda_data['resepsi']['time_start']) }}">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="resepsi_time_end">Waktu Selesai</label>
                           <input type="time" id="resepsi_time_end" class="form-control" name="resepsi_time_end" value="{{ old('resepsi_time_end', $order->agenda_data['resepsi']['time_end']) }}">
                        </div>
                     </div>
                  </div>
                  <div class="form-group mb-3">
                     <label for="resepsi_place">Tempat</label>
                     <div class="input-group mb-3">
                        <input type="text" name="resepsi_place" value="{{ old('resepsi_place', $order->agenda_data['resepsi']['place']) }}" class="form-control" id="resepsi_place" aria-label="Recipient's username" aria-describedby="resepsi_place">
                        <div class="input-group-append">
                           <button class="input-group-text" id="resepsi_place">copy</button>
                        </div>
                     </div>
                  </div>
                  <div class="form-group mb-3">
                     <label for="resepsi_maps">Link Google Map</label>
                     <div class="input-group mb-3">
                        <input type="text" name="resepsi_maps" value="{{ old('resepsi_maps', $order->agenda_data['resepsi']['maps']) }}" class="form-control" id="resepsi_maps" aria-label="Recipient's username" aria-describedby="resepsi_maps">
                        <div class="input-group-append">
                           <button class="input-group-text" id="resepsi_maps">copy</button>
                        </div>
                     </div>
                  </div>
               </div>
               
               <div class="col-lg-4">
                  <h3 class="h5  font-weight-bold">Ngunduh Mantu</h3>
                  <div class="form-group mb-3">
                     <label for="ngunduh_mantu_date">Tanggal</label>
                     <input type="date" id="ngunduh_mantu_date" class="form-control" name="ngunduh_mantu_date" value="{{ old('ngunduh_mantu_date', $order->agenda_data['ngunduh_mantu']['date']) }}">
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="ngunduh_mantu_time_start">Waktu Mulai</label>
                           <input type="time" id="ngunduh_mantu_time_start" class="form-control" name="ngunduh_mantu_time_start" value="{{ old('ngunduh_mantu_time_start', $order->agenda_data['ngunduh_mantu']['time_start']) }}">
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="ngunduh_mantu_time_end">Waktu Selesai</label>
                           <input type="time" id="ngunduh_mantu_time_end" class="form-control" name="ngunduh_mantu_time_end" value="{{ old('ngunduh_mantu_time_end', $order->agenda_data['ngunduh_mantu']['time_end']) }}">
                        </div>
                     </div>
                  </div>
                  <div class="form-group mb-3">
                     <label for="ngunduh_mantu_place">Tempat</label>
                     <div class="input-group mb-3">
                        <input type="text" name="ngunduh_mantu_place" value="{{ old('ngunduh_mantu_place', $order->agenda_data['ngunduh_mantu']['place']) }}" class="form-control" id="ngunduh_mantu_place" aria-label="Recipient's username" aria-describedby="ngunduh_mantu_place">
                        <div class="input-group-append">
                           <button class="input-group-text" id="ngunduh_mantu_place">copy</button>
                        </div>
                     </div>
                  </div>
                  <div class="form-group mb-3">
                     <label for="">Link Google Map</label>
                     <div class="input-group mb-3">
                        <input type="text" name="ngunduh_mantu_maps" value="{{ old('ngunduh_mantu_maps', $order->agenda_data['ngunduh_mantu']['maps']) }}" class="form-control" id="ngunduh_mantu_maps" aria-label="Recipient's username" aria-describedby="ngunduh_mantu_maps">
                        <div class="input-group-append">
                           <button class="input-group-text" id="ngunduh_mantu_maps">copy</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row justify-content-center my-5 d-flex">
               <button type="submit" name="action" value="update_only" class="btn-update-data btn btn-info px-4 mr-3">
                  <i class="fas fa-sync-alt mr-1"></i>
                  <strong>Update Data</strong>
               </button>
               <button type="submit" name="action" value="update_and_transaction" class="btn-update-n-trx btn btn-primary px-4">
                  <strong>Update & Buat Transaksi</strong>
                  <i class="fas fa-chevron-right ml-1"></i>
               </button>
            </div>
         </div>
      </div>
   </form>
@endsection

@push('script')
   <script>
      function updateInvitationDisplay() {
         const selectedValue = $('input[name="invitation_type"]:checked').val();
      
         $('#digital_invitation_section, #printed_invitation_section').hide();
         
         if (selectedValue === 'digital_invitation') {
            $('#digital_invitation_section').fadeIn(200);
            $('#printed_invitation_section #printed_quantity').val('');
            $('#printed_invitation_section #printed_price').val('');
            calculateTotal();
         }
         else if (selectedValue === 'printed_invitation') {
            $('#printed_invitation_section').fadeIn(200);
            $('#digital_invitation_section #digital_quantity').val('');
            $('#digital_invitation_section #digital_price').val('');
            calculateTotal();
         }
         else if (selectedValue === 'printed_digital') {
            $('#digital_invitation_section, #printed_invitation_section').fadeIn(200);
            calculateTotal();
         }
      }

      // Fungsi untuk copy ke clipboard dengan animasi
      function copyToClipboard(elementId) {
         // Dapatkan elemen input/textarea berdasarkan ID
         const inputElement = document.getElementById(elementId);
         
         // Copy value ke clipboard
         navigator.clipboard.writeText(inputElement.value)
            .then(() => {
                  // Dapatkan tombol copy
                  const copyButton = $(`button[id="${elementId}"]`);
                  
                  // Simpan teks asli
                  const originalText = copyButton.text();
                  const originalClass = copyButton.attr('class');
                  
                  // Ubah tampilan tombol
                  copyButton.text('Text copied!')
                     .removeClass(originalClass)
                     .addClass('input-group-text bg-dark text-white')
                     .css('transition', 'all 0.3s ease');
                  
                  // Kembalikan ke state semula setelah 3 detik
                  setTimeout(() => {
                     copyButton.text(originalText)
                        .removeClass('bg-dark text-white')
                        .addClass(originalClass);
                  }, 2000);
            })
            .catch(err => {
                  console.error('Gagal menyalin teks: ', err);
            });
      }


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
         let digitalPrice = unformatNumber($('input[name="digital_price"]').val());
         let printedPrice = unformatNumber($('input[name="printed_price"]').val());
         let addonPrice = unformatNumber($('input[name="addon_1_price"]').val());

         let total = digitalPrice + printedPrice + addonPrice;

         $('input[name="total_price"]').val(formatNumber(total));
      }

      $(document).ready(function() {
         // === UPDATE DISPLAY INVITATION
         $('input[name="invitation_type"]').change(updateInvitationDisplay);
         updateInvitationDisplay();

         // === FUNGSI COPY TO CLIPBOARD
         $('button[id]').on('click', function(e) {
            e.preventDefault();
            const elementId = $(this).attr('id');
            copyToClipboard(elementId);
         });

         // === CALCULATE TOTAL PRICE ===
         $('input[name="digital_price"], input[name="printed_price"], input[name="addon_1_price"]').on('input', function() {
            let value = $(this).val();
            let unformatted = unformatNumber(value);
            $(this).val(formatNumber(unformatted));
            
            calculateTotal();
         });

         calculateTotal();

         // Formating Created At
         const created_at = new Date('{{ $order->order_date ?? $order->created_at }}');
         const formatted_date = created_at.toISOString().split('T')[0];
         $('#order_date').val(formatted_date);
      });
   </script>
@endpush