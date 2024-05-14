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
        @can('master data')
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
              <a href="/jabatan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Gedung</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/pejabat" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Lantai </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/opd" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Ruang </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/data-jml-penduduk" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Rak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/data-jml-penduduk" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Baris</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/data-jml-penduduk" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Kolom</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/data-jml-penduduk" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Boks</p>
              </a>
            </li>

          </ul>
        </li>
        @endcan
        @can('benner')
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
              <a href="/adm-benner" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Instansi Eksternal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/adm-benner" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Unit Kerja Internal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/adm-benner" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Klasifikasi Arsip</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/adm-benner" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Jenis Naskah Dinas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/adm-benner" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Surat Keluar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/adm-benner" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Templet Surat Keluar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/adm-benner" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Jenis Pengaduan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/adm-benner" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Satuan Naskah</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/adm-benner" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Satuan Organisasi</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan
        @can('agenda pimpinan')
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-folder-open"></i>
            <p>
              Naskah Dinas
              <i class="fas fa-angle-right right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="/agenda-pejabat" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Surat Masuk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/agenda-pejabat" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Surat Keluar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/agenda-pejabat" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Informasi Templet</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/agenda-pejabat" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Retensi Surat</p>
              </a>
            </li>
          

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
            <li class="nav-item">
              <a href="/role" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Jabatan</p>
              </a>
            </li>
            @endcan

          </ul>
        </li>
        @endcan
        @can('portal_berita')
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
