@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Pengguna</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Data Pengguna</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Form Data Pengguna</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/user/update/{{ $user->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">

                            </div>
                            {{--  <div class="form-group">

                                <label>NIP USER</label>
                                <input type="text" name="nip" value="{{ old('nip', $user->nip) }}"
                                    placeholder="Masukkan Nama User"
                                    class="form-control @error('nip') is-invalid @enderror">

                                @error('nip')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror


                            </div>  --}}
                            <div class="form-group">

                                <label>Nama Pengguna</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    placeholder="Masukkan Pengguna"
                                    class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror


                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    placeholder="Masukkan Nama User"
                                    class="form-control @error('email') is-invalid @enderror">

                                @error('email')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" value="{{ old('password') }}"
                                            placeholder="Masukkan Password"
                                            class="form-control @error('password') is-invalid @enderror">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}"
                                            placeholder="Masukkan Konfirmasi Password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">ROLE</label>
                                <br>
                                @foreach ($roles as $role)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="role[]" value="{{ $role->name }}"
                                            id="check-{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="check-{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-edit"></i>
                                Ubah</button>
                            <button class="btn btn-danger btn-reset" type="reset"><i class="fa fa-trash"></i> Batal</button>

                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </section>



    @endsection
