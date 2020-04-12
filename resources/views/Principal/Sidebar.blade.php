
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
    <img src="{{asset('recursos_default/logo.jpg')}}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Prototipo</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('recursos_default/default.png')}}" class="img-circle elevation-2" alt="User Image" style="object-fit: cover; width:40px; height:40px;">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            @if (isset($users_logueado))
              {{$users_logueado[0]->nombre==null?'Admin':$users_logueado[0]->nombre}}
            @endif
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Usuario
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{url('/home')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lista de usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/allUser')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Registrar Usuario</p>
            </a>
          </li> 
            <li class="nav-item">
              <a href="{{url('/Areas')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Registrar Àrea</p>
              </a>
             </li>
          <li class="nav-item">
            <a href="{{url('/reporte')}}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Reporte</p>
              </a>
          </li>
              
            </ul>
          </li>
          {{-- <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>