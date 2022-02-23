 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
         <div class="sidebar-brand-text mx-3">&hearts; Kasher &hearts;</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('home') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span>
         </a>
     </li>

     <li class="nav-item {{ request()->routeIs('menu') ? 'active' : '' }}">
         <a class="nav-link " href="{{ route('menu') }}">
             <i class="fas fa-fw fa-utensils"></i>
             <span>Menu</span>
         </a>
     </li>

     <li class="nav-item {{ request()->routeIs('pesan') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('pesan') }}">
             <i class="fas fa-fw fa-cart-shopping"></i>
             <span>Pesanan</span>
         </a>
     </li>

     <li class="nav-item {{ request()->routeIs('transaksi') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('transaksi') }}">
             <i class="fas fa-fw fa-dollar-sign"></i>
             <span>Transaksi</span>
         </a>
     </li>

     <li class="nav-item {{ request()->routeIs('create-user') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('create-user') }}">
             <i class="fas fa-fw fa-user-gear"></i>
             <span>User</span>
         </a>
     </li>

     <hr class="sidebar-divider">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle">

         </button>
     </div>


 </ul>
