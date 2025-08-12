<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

   <!-- Sidebar - Brand -->
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
      <div class="sidebar-brand-icon rotate-n-15">
         <img src="{{ asset('img/kekko-logo.png') }}" alt="" style="width: 100%; height: auto; transform: rotate(15deg);">
      </div>
      <div class="sidebar-brand-text mx-3 text-left">{{ env('APP_NAME') }}</div>
   </a>

   <!-- Divider -->
   <hr class="sidebar-divider my-0">

   <!-- Nav Item - Dashboard -->
   <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dashboard') }}">
         <i class="fas fa-fw fa-tachometer-alt"></i>
         <span>Dashboard</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Nav Item - Transaksi -->
   <li class="nav-item {{ request()->routeIs('order') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('order') }}">
         <i class="fas fa-clipboard-list"></i>
         <span>Data Pesanan</span></a>
   </li>

   <!-- Nav Item - Transaksi -->
   <li class="nav-item">
      <a class="nav-link" href="#">
         <i class="fas fa-chart-line"></i>
         <span>Transaksi</span></a>
   </li>

   <!-- Nav Item - Produk -->
   <li class="nav-item {{ request()->routeIs('product*') ? 'active' : '' }}">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product"
         aria-expanded="true" aria-controls="product">
         <i class="fas fa-box"></i>
         <span>Produk</span>
      </a>
      <div id="product" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
               {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
               <a class="collapse-item {{ request()->routeIs('product*') ? 'active' : '' }}" href="{{ route('product') }}">Produk</a>
               <a class="collapse-item {{ request()->routeIs('product_theme*') ? 'active' : '' }}" href="{{ route('product_theme') }}">Tema</a>
               <a class="collapse-item {{ request()->routeIs('product_package*') ? 'active' : '' }}" href="{{ route('product_package') }}">Paket</a>
         </div>
      </div>
   </li>

   <!-- Nav Item - Pelanggan -->
   <li class="nav-item">
      <a class="nav-link" href="#">
         <i class="fas fa-user-friends"></i>
         <span>Pelanggan</span></a>
   </li>

   <!-- Nav Item - Pegawai -->
   <li class="nav-item">
      <a class="nav-link" href="#">
         <i class="fas fa-user-tie"></i>
         <span>Pegawai</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Nav Item - Pengaturan -->
   <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#setting"
         aria-expanded="true" aria-controls="setting">
         <i class="fas fa-fw fa-wrench"></i>
         <span>Pengaturan</span>
      </a>
      <div id="setting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
               {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
               <a class="collapse-item" href="#">Role User</a>
               <a class="collapse-item" href="#">Hak Akses</a>
         </div>
      </div>
   </li>

   <!-- Sidebar Toggler (Sidebar) -->
   <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
   </div>
</ul>