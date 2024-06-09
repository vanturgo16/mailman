
{{-- Jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- select 2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- MDI --}}
<link href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
{{-- Font Awesome --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
{{-- CKEDITOR --}}
<link href="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.css" rel="stylesheet">

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
      line-height: 28px;
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