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

      .btn-submit {
         width: 50%;
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
      <div class="card shadow p-3 mb-3">
         <h2>Data Pemesan</h2>
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
                  <label for="user_id">Employee</label>
                  <select name="user_id" id="user_id" class="form-control" disabled>
                     <option value="">Fulan bin Fulan</option>
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
            </div>
         </div>

         <div class="row">
            <div class="col-lg-4" id="invitation_type">
               <h3 class="h5">Nama Yang Didahulukan</h3>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="first_come" id="first_come_groom" value="groom" @if($order->order_information['first_come'] == 'groom') checked @endif>
                  <label class="form-check-label" for="first_come_groom">
                     Laki - Laki
                  </label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="first_come" id="first_come_bride" value="bride" @if($order->order_information['first_come'] == 'bride') checked @endif>
                  <label class="form-check-label" for="first_come_bride">
                     Perempuan
                  </label>
               </div>
            </div>
            <div class="col-lg-4">
               <h3 class="h5">Tipe Undangan</h3>
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
               <div class="mb-3" id="digital_invitation">
                  <h3 class="h5">Undangan Digital</h3>
                  <div class="form-group mb-3">
                     <label for="digital_theme">Tema Undangan</label>
                     <select id="digital_theme" name="digital_theme" class="form-control">
                        <option value="">Hazel</option>
                        <option value="">Heather</option>
                        <option value="">Java Heritage</option>
                     </select>
                     <small>Katalog : <a target="_blank" href="https://kekkoinvitation.com/">Klik Disini</a></small>
                  </div>
                  <div class="form-group mb-3">
                     <label for="digital_package">Paket Undangan</label>
                     <select id="digital_package" name="digital_package" class="form-control">
                        <option value="">Basic</option>
                        <option value="">Premium</option>
                        <option value="">Exlusive</option>
                     </select>
                  </div>
               </div>
               <hr>
               <div class="mb-3" id="printed_invitation">
                  <h3 class="h5">Undangan Cetak</h3>
                  <div class="form-group mb-3">
                     <label for="printed_type">Tipe Undangan</label>
                     <input id="printed_type" name="printed_type" type="text" class="form-control" placeholder="Ex: Tipe Zigna Mooi Lite" value="{{ $order->order_information['printed_invitation']['type'] }}">
                     <small>Katalog : <a target="_blank" href="https://wa.me/c/6285730739878">Klik Disini</a></small>
                  </div>
                  <div class="form-group mb-3">
                     <label for="printed_quantity">Jumlah</label>
                     <input type="text" id="printed_quantity" name="printed_quantity" inputmode="numeric" class="form-control" placeholder="Ex: 100" value="{{ $order->order_information['printed_invitation']['quantity'] }}">
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="card shadow p-3 mb-3" id="data-pengantin">
         <div class="row mb-2">
            <div class="col-lg-6 px-3" id="groom">
               <h2>Data Mempelai Pria</h2>
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
                     <input type="text" name="groom_instagram" value="{{ old('groom_instagram', $order->groom_bride_data['groom']['instagram']) }}" id="groom_instagram" class="form-control" aria-label="Groom Instagram">
                     <div class="input-group-append">
                        <button class="input-group-text" id="groom_instagram">copy</button>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6 px-3" id="bride">
               <h2>Data Mempelai Wanita</h2>
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
                     <input type="text" name="bride_instagram" value="{{ old('bride_instagram', $order->groom_bride_data['bride']['instagram']) }}" id="bride_instagram" class="form-control" aria-label="Amount (to the nearest dollar)">
                     <div class="input-group-append">
                        <button class="input-group-text" id="bride_instagram">copy</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="others">
            <h2>Lain - Lain</h2>
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

      <div class="card shadow p-3">
         <h2>Acara</h2>
         <div class="row">
            <div class="col-lg-4">
               <h3 class="h5">Akad Nikah</h3>
               <div class="form-group mb-3">
                  <label for="akad_date">Tanggal</label>
                  <input type="date" id="akad_date" class="form-control" name="akad_date" value="{{ old('akad_date', $order->agenda_data['akad']['date']) }}">
               </div>
               <div class="form-group mb-3">
                  <label for="akad_time">Waktu</label>
                  <input type="time" id="akad_time" class="form-control" name="akad_time" value="{{ old('akad_time', $order->agenda_data['akad']['time']) }}">
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
               <h3 class="h5">Resepsi Pernikahan</h3>
               <div class="form-group mb-3">
                  <label for="resepsi_date">Tanggal</label>
                  <input type="date" id="resepsi_date" class="form-control" name="resepsi_date" value="{{ old('resepsi_date', $order->agenda_data['resepsi']['date']) }}">
               </div>
               <div class="form-group mb-3">
                  <label for="resepsi_time">Waktu</label>
                  <input type="time" id="resepsi_time" class="form-control" name="resepsi_time" value="{{ old('resepsi_time', $order->agenda_data['resepsi']['time']) }}">
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
               <h3 class="h5">Ngunduh Mantu</h3>
               <div class="form-group mb-3">
                  <label for="ngunduh_mantu_date">Tanggal</label>
                  <input type="date" id="ngunduh_mantu_date" class="form-control" name="ngunduh_mantu_date" value="{{ old('ngunduh_mantu_date', $order->agenda_data['ngunduh_mantu']['date']) }}">
               </div>
               <div class="form-group mb-3">
                  <label for="ngunduh_mantu_time">Waktu</label>
                  <input type="time" id="ngunduh_mantu_time" class="form-control" name="ngunduh_mantu_time" value="{{ old('ngunduh_mantu_time', $order->agenda_data['ngunduh_mantu']['time']) }}">
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
         <div class="row justify-content-center my-5">
            <button type="submit" class="btn-submit btn btn-primary"><strong class="text-white">Update Data</strong></button>
         </div>
      </div>
   </form>
@endsection
