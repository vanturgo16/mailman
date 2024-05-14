@extends('layouts.blackand.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Permission</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Permission</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<div class="table-container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Form <small>Edit Permission</small></h3>
                    </div>
                </div>
               
    <div class="card-body">
                    <div class="card-body">
                        <form action="/role/update/{{ $role->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>NAMA ROLE</label>
                                <input type="text" name="name" value="{{ old('name', $role->name) }}" placeholder="Masukkan Nama Role"
                                    class="form-control @error('title') is-invalid @enderror">
    
                                @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
    
                            <div class="form-group">
                                <label class="font-weight-bold">PERMISSIONS</label>
                                <br>
                                @foreach ($permissions as $permission)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="check-{{ $permission->id }}" @if($role->permissions->contains($permission)) checked @endif>
                                    <label class="form-check-label" for="check-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
    
                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                                UPDATE</button>
                            <button class="btn btn-danger btn-reset" type="reset"><i class="fa fa-remove"></i> RESET</button>
    
                        </form>
                    
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 

  
    @endsection