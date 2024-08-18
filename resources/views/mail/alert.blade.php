
<!-- Notifikasi menggunakan flash session data -->
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('fail'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('fail') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!--validasi form with $validate-->
@if (count($errors)>0)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="mdi mdi-block-helper label-icon"></i><strong>&nbsp; Data Gagal Disimpan!</strong>
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