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
   <div class="card shadow p-3 mb-3">
      <h2>Data Pemesan</h2>
      <div class="row mb-3">
         <div class="col-lg-6">
            <div class="form-group mb-2">
               <label for="customer_name">Nama Pemesan</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="customer_name" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="customer_name" >
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
                  <input type="text" class="form-control" id="customer_phone" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="customer_phone" >
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
               <input class="form-check-input" type="radio" name="name_first" id="first_come_groom" value="groom" checked>
               <label class="form-check-label" for="first_come_groom">
                  Laki - Laki
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="radio" name="name_first" id="first_come_bride" value="bride">
               <label class="form-check-label" for="first_come_bride">
                  Perempuan
               </label>
            </div>
         </div>
         <div class="col-lg-4">
            <h3 class="h5">Tipe Undangan</h3>
            <div class="form-check">
               <input class="form-check-input" type="radio" name="invitation_type" id="printed_invitation" value="printed_invitation" checked>
               <label class="form-check-label" for="printed_invitation">
                  Cetak
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="radio" name="invitation_type" id="digital_invitation" value="digital_invitation">
               <label class="form-check-label" for="digital_invitation">
                  Digital
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="radio" name="invitation_type" id="printed_digital" value="printed_digital">
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
                  <select id="digital_theme" name="" class="form-control">
                     <option value="">Hazel</option>
                     <option value="">Heather</option>
                     <option value="">Java Heritage</option>
                  </select>
                  <small>Katalog : <a target="_blank" href="https://kekkoinvitation.com/">Klik Disini</a></small>
               </div>
               <div class="form-group mb-3">
                  <label for="">Paket Undangan</label>
                  <select name="" class="form-control">
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
                  <label for="printed_theme">Tipe Undangan</label>
                  <input id="printed_theme" type="text" class="form-control" placeholder="Ex: Tipe Zigna Mooi Lite">
                  <small>Katalog : <a target="_blank" href="https://wa.me/c/6285730739878">Klik Disini</a></small>
               </div>
               <div class="form-group mb-3">
                  <label for="">Jumlah</label>
                  <input type="text" inputmode="numeric" class="form-control" placeholder="Ex: 100">
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
                  <input type="text" class="form-control" id="groom_name" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="groom_name" >
                  <div class="input-group-append">
                     <button class="input-group-text" id="groom_name">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="groom_nickname">Nama Panggilan</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="groom_nickname" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="groom_nickname" >
                  <div class="input-group-append">
                     <button class="input-group-text" id="groom_nickname">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="groom_father_name">Nama Ayah</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="groom_father_name" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="groom_father_name" >
                  <div class="input-group-append">
                     <button class="input-group-text" id="groom_father_name">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="groom_mother_name">Nama Ibu</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="groom_mother_name" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="groom_mother_name" >
                  <div class="input-group-append">
                     <button class="input-group-text" id="groom_mother_name">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="groom_number_child">Urutan Anak Dalam Keluarga</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="groom_number_child" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="groom_number_child" >
                  <div class="input-group-append">
                     <button class="input-group-text" id="groom_number_child">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="groom_address">Alamat Lengkap</label>
               <textarea id="groom_address" class="form-control mb-2" rows="3" name="groom_address" ></textarea>
               <div style="width:100%; justify-items: right;">
                  <button class="input-group-text" id="groom_address">copy address</button>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="groom_phone">No. Whatsapp</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="groom_phone" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="groom_phone">
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
                  <input type="text" id="groom_instagram" class="form-control" aria-label="Amount (to the nearest dollar)">
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
                  <input type="text" class="form-control" id="bride_name" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="bride_name" >
                  <div class="input-group-append">
                     <button class="input-group-text" id="bride_name">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="bride_nickname">Nama Panggilan</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="bride_nickname" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="bride_nickname" >
                  <div class="input-group-append">
                     <button class="input-group-text" id="bride_nickname">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="bride_father_name">Nama Ayah</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="bride_father_name" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="bride_father_name" >
                  <div class="input-group-append">
                     <button class="input-group-text" id="bride_father_name">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="bride_mother_name">Nama Ibu</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="bride_mother_name" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="bride_mother_name" >
                  <div class="input-group-append">
                     <button class="input-group-text" id="bride_mother_name">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="bride_number_child">Urutan Anak Dalam Keluarga</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="bride_number_child" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="bride_number_child" >
                  <div class="input-group-append">
                     <button class="input-group-text" id="bride_number_child">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="bride_address">Alamat Lengkap</label>
               <textarea id="bride_address" class="form-control mb-2" rows="3" name="bride_address" ></textarea>
               <div style="width:100%; justify-items: right;">
                  <button class="input-group-text" id="bride_address">copy address</button>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="bride_phone">No. Whatsapp</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="bride_phone" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="bride_phone">
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
                  <input type="text" id="bride_instagram" class="form-control" aria-label="Amount (to the nearest dollar)">
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
            <input type="text" id="link_gdrive" class="form-control" name="link_gdrive">
         </div>
         <div class="form-group mb-3">
            <label for="backsound_music">Backsound Musik</label>
            <input type="text" id="backsound_music" class="form-control" name="backsound_music">
         </div>
         <div class="form-group mb-3">
            <label for="notes">Catatan Tambahan</label>
            <textarea id="notes" class="form-control" name="notes" rows="5"></textarea>
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
               <input type="date" id="akad_date" class="form-control" name="akad_date">
            </div>
            <div class="form-group mb-3">
               <label for="akad_time">Waktu</label>
               <input type="time" id="akad_time" class="form-control" name="akad_time">
            </div>
            <div class="form-group mb-3">
               <label for="akad_place">Tempat</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="akad_place" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="akad_place">
                  <div class="input-group-append">
                     <button class="input-group-text" id="akad_place">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="">Link Google Map</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="akad_maps" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="akad_maps">
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
               <input type="date" id="resepsi_date" class="form-control" name="resepsi_date">
            </div>
            <div class="form-group mb-3">
               <label for="resepsi_time">Waktu</label>
               <input type="time" id="resepsi_time" class="form-control" name="resepsi_time">
            </div>
            <div class="form-group mb-3">
               <label for="resepsi_place">Tempat</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="resepsi_place" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="resepsi_place">
                  <div class="input-group-append">
                     <button class="input-group-text" id="resepsi_place">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="resepsi_maps">Link Google Map</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="resepsi_maps" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="resepsi_maps">
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
               <input type="date" id="ngunduh_mantu_date" class="form-control" name="ngunduh_mantu_date">
            </div>
            <div class="form-group mb-3">
               <label for="ngunduh_mantu_time">Waktu</label>
               <input type="time" id="ngunduh_mantu_time" class="form-control" name="ngunduh_mantu_time">
            </div>
            <div class="form-group mb-3">
               <label for="ngunduh_mantu_place">Tempat</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="ngunduh_mantu_place" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="ngunduh_mantu_place">
                  <div class="input-group-append">
                     <button class="input-group-text" id="ngunduh_mantu_place">copy</button>
                  </div>
               </div>
            </div>
            <div class="form-group mb-3">
               <label for="">Link Google Map</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" id="ngunduh_mantu_maps" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="ngunduh_mantu_maps">
                  <div class="input-group-append">
                     <button class="input-group-text" id="ngunduh_mantu_maps">copy</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
