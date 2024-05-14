@extends('layouts.frontand.app')
@section('content')
<div class="container py-5">
    <div class="row pt-5">
        <div class="col-lg-8">
            {{--  <div class="d-flex flex-column text-left mb-4">
                <h6 class="text-primary font-weight-normal text-uppercase mb-3">Blog Detail Page</h6>
                <h1 class="mb-4 section-title">Diam dolor est ipsum clita lorem</h1>
                <div class="d-index-flex mb-2">
                    <span class="mr-3"><i class="fa fa-user text-primary"></i> Admin</span>
                    <span class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</span>
                    <span class="mr-3"><i class="fa fa-comments text-primary"></i> 15</span>
                </div>
            </div>  --}}

            <div class="mb-5">
                
                <h2 class="mb-4">Sambutan Kepala Desa</h2>
                <p style="text-align: justify">{{ $sambutan->des }}</p>
                
                <p style="text-align: justify">{{ $sambutan->des1 }}</p>
            </div>


            
        </div>

        <div class="col-lg-4 mt-5 mt-lg-0">
            <div class="d-flex flex-column text-center bg-secondary mb-5 py-5 px-4">

                <img src="{{ Storage::url('public/staff/'.$sambutan->foto) }}" class="img-fluid mx-auto mb-3" style="width: 100px;">
                <h3 class="text-primary mb-3">{{ $sambutan->nm_kep }}</h3>
                <h5 class="text-primary mb-3">Kepala {{ $profil_desa->nm_desa }}</h5>

            </div>
            </div>
           
           
            
        </div>
    </div>
</div>
@endsection