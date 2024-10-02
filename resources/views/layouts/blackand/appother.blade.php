<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/blackend/img_sk/logo.png') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>E-Minu Polri</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('blackend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('blackend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('blackend/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('blackend/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('blackend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('blackend/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('blackend/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- BS Stepper -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('blackend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('blackend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('blackend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('blackend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
  <!-- MDI -->
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

  <style>
    .dsb {
      background-color: #ffff;
      color: #4a4a50;
    }
    .dsb:hover {
        background-color: #4a4a50;
        color: #ffff;
        cursor: no-drop;
    }
  
    .drpdwn {
        background-color: #ffff;
        color: #151a48;
    }
    .drpdwn:hover {
        background-color: #4e73df;
        color: #ffff;
    }
  
    .drpdwn-act:hover {
        background-color: green;
        color: #ffff;
    }
    .drpdwn-dgr:hover {
        background-color: red;
        color: #ffff;
    }
    
    .select2-container .select2-selection--single {
      height: 38px;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
    }
  
    .select2-container--default
        .select2-selection--single
        .select2-selection__rendered {
        line-height: 30px;
        color: #495057;
    }
  
    .select2-container--default
        .select2-selection--single
        .select2-selection__arrow {
        height: 30px;
    }
  
    .modal-header-custom {
      background-color: #5156be;
      color: white;
      border-bottom: none;
    }
  
    .modal-header-custom .modal-title-custom {
        color: inherit;
    }
  
    .modal-header-custom button.btn-close-custom {
        background-color: #ffffff;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.blackand.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.blackand.sidebarmenu')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{--  @include('layouts.blackand.header')  --}}

    <!-- Main content -->
    <section class="content">
      @yield('content')
      @include('sweetalert::alert')
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2024 <a href="/">E-Minu Polri</a></strong> - All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- DataTables & Plugins -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- SweetAlert -->
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('blackend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('blackend/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('blackend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('blackend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('blackend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('blackend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('blackend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('blackend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('blackend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('blackend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('blackend/dist/js/adminlte.js') }}"></script>
{{-- 
<script>
  $(document).on("shown.bs.modal", ".modal", function () {
    $(".js-example-basic-single").select2({
        dropdownParent: this,
    });
  });

  $(".js-example-basic-single").select2();

  $(document).on("hidden.bs.modal", ".modal", function () {
      $(".js-example-basic-single").select2();
  });
</script> --}}

  {{-- SummerNote --}}
  <script>
    $(document).ready(function() {
        $('.summernote-editor').summernote();
        $(document).on('shown.bs.modal', function (e) {
            $(e.target).find('.summernote-editor').summernote();
        });
    });
  </script>

</body>
</html>
