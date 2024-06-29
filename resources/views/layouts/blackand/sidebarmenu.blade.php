<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="{{ asset('blackend/img_sk/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">

    <span class="brand-text font-weight-light">E-Minu Polri</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if (Auth::user()->profile_photo_path!=null)
        <img src="{{ Storage::url('public/staff/'.Auth::user()->profile_photo_path.'') }}" class="img-thumbnail" alt="{{ Auth::user()->name }}"/>

        @else
        <img src="{{ asset('blackend/dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">

        @endif

      </div>
      <div class="info">
        <a href="/profil" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Beranda
              <span class="right badge badge-danger"></span>
            </p>
          </a>
        </li>
        
        @can('master dropdown')
        <li class="nav-item">
          <a href="{{ url('/dropdown') }}" class="nav-link">
            <i class="nav-icon fas fa-caret-square-down"></i>
            <p>
              Master Dropdown
              <span class="right badge badge-danger"></span>
            </p>
          </a>
        </li>
        @endcan
        @can('lokasi simpan')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
                Lokasi Simpan
              <i class="fas fa-angle-right right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href={{ url('/gedung') }} class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Gedung</p>
              </a>
            </li>

            <li class="nav-item">
              <a href={{ url('/lantai') }} class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Lantai </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/ruang') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Ruang </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ url('/rak') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Rak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/baris') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Baris</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/kolom') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Kolom</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/boks') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Boks</p>
              </a>
            </li>

          </ul>
        </li>
        @endcan
        @can('master parameter')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Master Parameter
              <i class="fas fa-angle-right right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{ url('/instansi') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Instansi Eksternal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/unitkerja') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Unit Kerja Internal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/klasifikasi') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Klasifikasi Arsip</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/naskah') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Jenis Naskah Dinas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/template') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Template Surat Keluar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/pengaduan') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Jenis Pengaduan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/satnas') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Satuan Naskah</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/sator') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Satuan Organisasi</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan
        @can('naskah dinas')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>
              Naskah Dinas
              <i class="fas fa-angle-right right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">

            @can('surat_masuk')
            <li class="nav-item">
              <a href="{{ route('incommingmail.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Surat Masuk</p>
              </a>
            </li>
            @endcan
            @can('surat_keluar')
            <li class="nav-item">
              <a href="{{ route('outgoingmail.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Surat Keluar</p>
              </a>
            </li>
            @endcan

            @can('info_templet_keluar')
            <li class="nav-item">
              <a href="{{ url('list-template-keluar') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Info Template Keluar</p>
              </a>
            </li>
            @endcan
            {{-- @can('data_retensi_surat')
            <li class="nav-item">
              <a href="/agenda-pejabat" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Retensi Surat</p>
              </a>
            </li>
            @endcan --}}

          </ul>
        </li>
        @endcan

        @can('manajemen_pengguna')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Manajemen Pengguna
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
        @can('data_pengguna')

            <li class="nav-item">
              <a href="/user" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Pengguna</p>
              </a>
            </li>
        @endcan
        @can('permession')

            <li class="nav-item">
              <a href="/permission" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Permission</p>
              </a>
            </li>
        @endcan
        @can('role')  
            <li class="nav-item">
              <a href="/role" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Role</p>
              </a>
            </li>
            @endcan

          </ul>
        </li>
        @endcan
        @can('pbekup_data')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-download"></i>
            <p>
              Backup Data
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          
            <li class="nav-item">
              <a href="/data-berita" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Backup & Restor Arsip</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/about-desa" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Backup Arsip </p>
              </a>
            </li>

            
          </ul>
        </li>

        @endcan
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
