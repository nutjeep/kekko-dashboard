@extends('layouts.app_fe')

@push('style')
   <style>
      hr {
         background-color: rgba(0, 0, 0, 0.3);
         height: .2px;
         margin-top: 20px;
         margin-bottom: 20px;
      }

      h2 {
         font-weight: 600;
         font-size: 24px;
      }

      label {
         margin-bottom: 4px;
      }

      .add-ngunduh-mantu {
         display: flex;
         justify-content: center;
         align-items: center;
         gap: 10px;
         font-weight: 700;
         color: red;
      }

      .agenda {
         display: flex;
         flex-wrap: wrap;
         justify-content: center;
         align-items: center;
         width: 100%;
      }

      .agenda .agenda-item {
         padding: 10px;
         width: 33%;
         text-align: center;
         border: .8px solid rgb(231, 231, 231);
         color: rgb(146, 146, 146);
         cursor: pointer;
         transition: all 0.3s ease;
      }

      .agenda-item-1:hover {
         background-color: #c6e1ff;
         color: #003875;
      }

      .agenda-item-2:hover {
         background-color: #deffe5;
         color: #026218;
      }

      .agenda-item-3:hover {
         background-color: #fff7df;
         color: #a07800;
      }

      .agenda .agenda-item.active {
         font-weight: bold;
      }

      .agenda-item-1.active {
         background-color: #7dbcff !important;
         color: #003875 !important;
      }

      .agenda-item-2.active {
         background-color: #6fd286 !important;
         color: #026218 !important;
      }

      .agenda-item-3.active {
         background-color: #ffe699 !important;
         color: #a07800 !important;
      }

      .btn-submit {
         width: 50%;
      }

      @media screen and (max-width: 576px) {
         .agenda .agenda-item {
         width: 100% !important;
         }
      }
   </style>
@endpush

@section('content')
   <h1 class="text-center mb-3">Data Pesanan</h1>

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
         <button type="button" class="close btn-close-alert" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
         </button>
      </div>
   @endif

   <form class="form" action="{{ route('send.order_data') }}" method="post">
      @csrf
      <div class="row">
         <div class="col-lg-4 section-left">
            <div class="card p-3 shadow-sm">
               <h2 class="pb-3 border-bottom">Informasi Pemesan</h2>
               <div class="form-group mb-2">
                  <label for="customer_name">Nama Pemesan</label>
                  <input type="text" id="customer_name" name="customer_name" class="form-control" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
               </div>

               <div class="form-group mb-3">
                  <label for="customer_phone">No Whatsapp</label>
                  <input type="text" id="customer_phone" name="customer_phone" inputmode="numeric" class="form-control" placeholder="Ex: 081234567899" oninput="this.value = this.value.replace(/[^\d.]/g, '')" required>
               </div>

               <div class="mb-3">
                  <h3 class="h5">Nama Yang Didahulukan</h3>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="first_come" id="first_come_groom" value="groom" checked>
                     <label class="form-check-label" for="first_come_groom">
                        Pria
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" type="radio" name="first_come" id="first_come_bride" value="bride">
                     <label class="form-check-label" for="first_come_bride">
                        Wanita
                     </label>
                  </div>
               </div>

               <div id="invitation_type">
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

               <hr>

               <div class="mb-3" id="digital_invitation_section">
                  <h3 class="h5">Undangan Digital</h3>
                  <div class="form-group mb-3">
                     <label for="digital_theme">Tema Undangan</label>
                     <select id="digital_theme" name="digital_theme" id="digital_theme" class="form-control">
                        <option value="hazel">Hazel</option>
                        <option value="heather">Heather</option>
                        <option value="java heritage">Java Heritage</option>
                     </select>
                     <small>Katalog : <a target="_blank" href="https://kekkoinvitation.com/">Klik Disini</a></small>
                  </div>
                  <div class="form-group mb-3">
                     <label for="digital_package">Paket Undangan</label>
                     <select id="digital_package" name="digital_package" id="digital_package" class="form-control">
                        <option value="basic">Basic</option>
                        <option value="premium">Premium</option>
                        <option value="exclusive">Exlusive</option>
                     </select>
                  </div>
               </div>

               <div class="mb-3" id="printed_invitation_section">
                  <h3 class="h5">Undangan Cetak</h3>
                  <div class="form-group mb-3">
                     <label for="printed_type">Tipe Undangan</label>
                     <input id="printed_type" name="printed_type" id="printed_type" type="text" class="form-control" placeholder="Ex: Tipe Zigna Mooi Lite" oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                     <small>Katalog : <a target="_blank" href="https://wa.me/c/6285730739878">Klik Disini</a></small>
                  </div>
                  <div class="form-group mb-3">
                     <label for="printed_quantity">Jumlah</label>
                     <input type="text" id="printed_quantity" name="printed_quantity" inputmode="numeric" class="form-control" placeholder="Ex: 100" oninput="this.value = this.value.replace(/[^\d.]/g, '')">
                  </div>
               </div>
            </div>
         </div>

         <div class="col-lg-8 section-right">
            <div class="card p-3 shadow-sm">
               <div class="data-pengantin">
                  {{-- Pengantin Pria --}}
                  <div class="groom"> 
                     <h2>Data Mempelai Pria</h2>
                     <div class="form-group mb-3">
                        <label for="groom_name">Nama Lengkap</label>
                        <input type="text" id="groom_name" class="form-control" name="groom_name" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                     </div>
                     <div class="form-group mb-3">
                        <label for="groom_nickname">Nama Panggilan</label>
                        <input type="text" id="groom_nickname" class="form-control" name="groom_nickname" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                     </div>
                     <div class="form-group mb-3">
                        <label for="groom_father_name">Nama Ayah</label>
                        <input type="text" id="groom_father_name" class="form-control" name="groom_father_name" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                     </div>
                     <div class="form-group mb-3">
                        <label for="groom_mother_name">Nama Ibu</label>
                        <input type="text" id="groom_mother_name" class="form-control" name="groom_mother_name" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                     </div>
                     <div class="form-group mb-3">
                        <label for="groom_number_child">Urutan Anak Dalam Keluarga</label>
                        <input type="text" id="groom_number_child" name="groom_number_child" class="form-control" placeholder="Cth: Pertama / Kedua" required>
                     </div>
                     <div class="form-group mb-3">
                        <label for="groom_address">Alamat Lengkap</label>
                        <textarea id="groom_address" class="form-control" rows="3" name="groom_address" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());"></textarea>
                     </div>
                     <div class="form-group mb-3">
                        <label for="groom_phone">No. Whatsapp</label>
                        <input type="text" id="groom_phone" name="groom_phone" class="form-control" placeholder="Cth: 08123456789" inputmode="numeric" oninput="this.value = this.value.replace(/[^\d.]/g, '')">
                     </div>
                     <div class="mb-3">
                        <label for="groom_instagram">Akun Instagram</label>
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <span class="input-group-text" id="groom_instagram">@</span>
                           </div>
                           <input type="text" id="groom_instagram" name="groom_instagram" class="form-control" placeholder="Cth: dian_febrian" aria-label="Username" aria-describedby="groom_instagram" oninput="this.value = this.value.replace(/\s+/g, '').toLowerCase();">
                        </div>
                     </div>
                  </div>

                  <hr>

                  {{-- Pengantin Wanita --}}
                  <div class="bride">
                  <h2>Data Mempelai Wanita</h2>
                  <div class="form-group mb-3">
                     <label for="bride_name">Nama Lengkap</label>
                     <input type="text" id="bride_name" class="form-control" name="bride_name" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                  </div>
                  <div class="form-group mb-3">
                     <label for="bride_nickname">Nama Panggilan</label>
                     <input type="text" id="bride_nickname" class="form-control" name="bride_nickname" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                  </div>
                  <div class="form-group mb-3">
                     <label for="bride_father_name">Nama Ayah</label>
                     <input type="text" id="bride_father_name" class="form-control" name="bride_father_name" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                  </div>
                  <div class="form-group mb-3">
                     <label for="bride_mother_name">Nama Ibu</label>
                     <input type="text" id="bride_mother_name" class="form-control" name="bride_mother_name" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());">
                  </div>
                  <div class="form-group mb-3">
                     <label for="bride_number_child">Urutan Anak Dalam Keluarga</label>
                     <input type="text" id="bride_number_child" class="form-control" placeholder="Cth: Pertama / Kedua" name="bride_number_child" required>
                  </div>
                  <div class="form-group mb-3">
                     <label for="bride_address">Alamat Lengkap</label>
                     <textarea id="bride_address" class="form-control" rows="3" name="bride_address" required oninput="this.value = this.value.replace(/\s{2,}/g, ' ').toLowerCase().replace(/\b\w/g, c => c.toUpperCase());"></textarea>
                  </div>
                  <div class="form-group mb-3">
                     <label for="bride_phone">No. Whatsapp</label>
                     <input class="form-control" id="bride_phone" name="bride_phone" placeholder="Cth: 08123456789" inputmode="numeric"  oninput="this.value = this.value.replace(/[^\d.]/g, '')">
                  </div>
                  <div class="mb-3">
                     <label for="bride_instagram">Akun Instagram</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="bride_instagram">@</span>
                        </div>
                        <input type="text" id="bride_instagram" name="bride_instagram" class="form-control" placeholder="Cth: asmara.dita" aria-label="Username" aria-describedby="bride_instagram" oninput="this.value = this.value.replace(/\s+/g, '').toLowerCase();">
                     </div>
                  </div>
                  </div>
               </div>

               <hr>

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

               <hr>

               <h2 class="text-center">Pilih Acara</h2>
               <span class="text-danger text-center mb-3">Isi detail acara yang akan dicantumkan pada undangan!</span>
               <div class="agenda mb-5">
                  <div class="agenda-item agenda-item-1 akad">
                     Akad
                  </div>
                  <div class="agenda-item agenda-item-2 resepsi">
                     Resepsi
                  </div>
                  <div class="agenda-item agenda-item-3 ngunduh_mantu">
                     Ngunduh Mantu
                  </div>
               </div>

               {{-- Akad --}}
               <div class="akad_section">
                  <h2>Akad Nikah</h2>
                  <div class="form-group mb-3">
                     <label for="akad_date">Tanggal</label>
                     <input type="date" id="akad_date" class="form-control" name="akad_date" required>
                  </div>
                  <div class="form-group mb-3">
                     <label for="akad_time">Waktu</label>
                     <input type="time" id="akad_time" class="form-control" name="akad_time" required>
                  </div>
                  <div class="form-group mb-3">
                     <label for="akad_place">Tempat</label>
                     <input type="text" id="akad_place" class="form-control" name="akad_place" placeholder="Cth: Kediaman Mempelai Wanita" required>
                  </div>
                  <div class="form-group mb-3">
                     <label for="">Link Google Map</label>
                     <input type="text" id="akad_maps" class="form-control" name="akad_maps">
                  </div>
               </div>
               
               {{-- Resepsi --}}
               <div class="resepsi_section">
                  <hr>
                  <h2>Resepsi Pernikahan</h2>
                  <div class="form-group mb-3">
                     <label for="resepsi_date">Tanggal</label>
                     <input type="date" id="resepsi_date" class="form-control" name="resepsi_date" required>
                  </div>
                  <div class="form-group mb-3">
                     <label for="resepsi_time">Waktu</label>
                     <input type="time" id="resepsi_time" class="form-control" name="resepsi_time" required>
                  </div>
                  <div class="form-group mb-3">
                     <label for="resepsi_place">Tempat</label>
                     <input type="text" id="resepsi_place" class="form-control" name="resepsi_place" placeholder="Cth: Kediaman Mempelai Pria" required>
                  </div>
                  <div class="form-group mb-3">
                     <label for="resepsi_maps">Link Google Map</label>
                     <input type="text" id="resepsi_maps" class="form-control" name="resepsi_maps">
                  </div>
               </div>

               {{-- Ngunduh Mantu --}}
               <div class="ngunduh_mantu_section">
                  <hr>
                  <h2>Ngunduh Mantu</h2>
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
                     <input type="text" id="ngunduh_mantu_place" class="form-control" name="ngunduh_mantu_place" placeholder="Cth: Kediaman Mempelai Pria">
                  </div>
                  <div class="form-group mb-3">
                     <label for="ngunduh_mantu_maps">Link Google Map</label>
                     <input type="text" id="ngunduh_mantu_maps" class="form-control" name="ngunduh_mantu_maps">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row justify-content-center my-5">
         <button type="submit" class="btn-submit btn btn-primary"><strong class="text-white">Kirim Data</strong></button>
      </div>
   </form>
@endsection

@push('script')
<script>
   function updateAgendaItemStyle(item) {
      var $item = $(item);
      
      // Reset semua style ke default
      $item.css({
         'background-color': '',
         'color': $item.hasClass('agenda-item-1') ? '#003875' : 
                  $item.hasClass('agenda-item-2') ? '#026218' : '#a07800'
      });

      // Jika active, terapkan style yang lebih gelap
      if ($item.hasClass('active')) {
         var bgColor = $item.hasClass('agenda-item-1') ? '#7dbcff' : 
                     $item.hasClass('agenda-item-2') ? '#6fd286' : '#ffe699';
         
         $item.css({
         'background-color': bgColor,
         'color': $item.hasClass('agenda-item-1') ? '#003875' : 
                  $item.hasClass('agenda-item-2') ? '#026218' : '#a07800'
         });
      }
   }

   function handleNameOrderChange() {
      // if ($('#first_come_groom').is(':checked')) {
      //    // Jika mempelai pria yang dipilih dahulu
      //    $('.data-pengantin').prepend($('.groom'));
      //    $('.data-pengantin').append($('.bride'));
      // } else {
      //    // Jika mempelai wanita yang dipilih dahulu
      //    $('.data-pengantin').prepend($('.bride'));
      //    $('.data-pengantin').append($('.groom'));
      // }

      $('.groom, .bride').fadeOut(200, function () {
        if ($('#first_come_groom').is(':checked')) {
            $('.groom').prependTo('.data-pengantin').fadeIn(200); // menyisipkan elemen groom di awal elemen .data-pengantin
            $('.bride').appendTo('.data-pengantin').fadeIn(200); // menyisipkan elemen bride di akhir elemen .data-pengantin
        } else {
            $('.bride').prependTo('.data-pengantin').fadeIn(200);
            $('.groom').appendTo('.data-pengantin').fadeIn(200);
        }
    });
   }

   function updateInvitationDisplay() {
      const selectedValue = $('input[name="invitation_type"]:checked').val();
      
      $('#digital_invitation_section, #printed_invitation_section').hide();
      
      if (selectedValue === 'digital_invitation') {
         $('#digital_invitation_section').fadeIn(200);
      }
      else if (selectedValue === 'printed_invitation') {
         $('#printed_invitation_section').fadeIn(200);
      }
      else if (selectedValue === 'printed_digital') {
         $('#digital_invitation_section, #printed_invitation_section').fadeIn(200);
      }
   }

   $(document).ready(function() {
      // == PENGATURAN SEKSI PENDAHULUAN SEKSI GROOM/BRIDE ==
      handleNameOrderChange();

      $('input[name="first_come"]').change(function() {
         handleNameOrderChange();
      });
      
      // == MENAMPILKAN / MENYEMBUNYIKAN SEKSI AGENDA ==
      $('.akad_section, .resepsi_section, .ngunduh_mantu_section').hide();
      $('.agenda-item').click(function() {
         // Toggle class active pada item yang diklik
         $(this).toggleClass('active');
         
         let agendaType = $(this).hasClass('akad') ? 'akad' : 
            $(this).hasClass('resepsi') ? 'resepsi' : 'ngunduh_mantu';

         // Tampilkan section yang sesuai
         $('.' + agendaType + '_section').toggle();

         // Update styling berdasarkan active state
         updateAgendaItemStyle(this);

         $('<style>')
            .text(`
            .agenda-item.active {
               font-weight: bold;
            }
            .agenda-item-1.active {
               background-color: #7dbcff !important;
               color: #003875 !important;
            }
            .agenda-item-2.active {
               background-color: #6fd286 !important;
               color: #026218 !important;
            }
            .agenda-item-3.active {
               background-color: #ffe699 !important;
               color: #a07800 !important;
            }
            `)
            .appendTo('head');
      });

      // === UPDATE DISPLAY INVITATION
      $('input[name="invitation_type"]').change(updateInvitationDisplay);
      updateInvitationDisplay();

      // -- VALIDASI FORM TIPE UNDANGAN
      document.querySelector('form').addEventListener('submit', function(e) {
         const selectedType = $('input[name="invitation_type"]:checked').value;
         const digitalTheme = $('#digital_theme').value;
         const printedType = $('#printed_type').value;
         
         if (selectedType.includes('digital') && !digitalTheme) {
            e.preventDefault();
            alert('Silakan pilih tema undangan digital');
         }
         
         if (selectedType.includes('printed') && !printedType) {
            e.preventDefault();
            alert('Silakan isi tipe undangan cetak');
         }
      });
   
      // === CLOSE ALERT
      $('.btn-close-alert').click(function() {
         $(this).closest('.alert').fadeOut(200);
      });
   });
</script>
  
@endpush