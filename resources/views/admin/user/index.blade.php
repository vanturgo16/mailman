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
<div class="row">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- /.card -->

                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                                            href="#custom-tabs-three-home" role="tab"
                                            aria-controls="custom-tabs-three-home" aria-selected="true">Data User
                                            Administrator</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-three-profile" role="tab"
                                            aria-controls="custom-tabs-three-profile" aria-selected="false">Data User
                                            </a>
                                    </li>
                                    {{--  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Ditolak</a>
                  </li>  --}}
                                    <li class="nav-item">
                                        {{--  <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Settings</a>  --}}
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-three-home-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <a href="/user/create"><i class="fa fa-plus"></i> </a>
                                                    Tambah Data Administrator</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">

                                                <table id="example1" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="text-align: center;width: 6%">No.
                                                            </th>
                                                            <th scope="col">Nama Pengguna</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">No Tlp</th>
                                                            <th scope="col">Role</th>
                                                            <th scope="col" style="width: 15%;text-align: center">Aksi
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($users as $no => $user)
                                                        <tr>
                                                            <th scope="row" style="text-align: center">{{ ++$no}}</th>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td>
                                                                @if(!empty($user->getRoleNames()))
                                                                @foreach($user->getRoleNames() as $role)
                                                                <label class="badge badge-success">{{ $role }}</label>
                                                                @endforeach
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                {{--  @can('users.edit')  --}}
                                                                <a href="/user/edit/{{$user->id}}"
                                                                    class="btn btn-xs btn-primary">
                                                                    <i class="fa fa-edit"> Ubah</i>
                                                                </a>
                                                                {{--  @endcan  --}}

                                                                {{--  @can('users.delete')  --}}
                                                                <button onClick="Delete(this.id)"
                                                                    class="btn btn-xs btn-danger" id="{{ $user->id }}">
                                                                    <i class="fa fa-trash"> Hapus</i>
                                                                </button>
                                                                {{--  @endcan  --}}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-three-profile-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <a href=""><i class="fa fa-users"></i> </a>
                                                     Data Pengguna OPD</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">

                                                <table id="example3" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="text-align: center;width: 6%">No.
                                                            </th>
                                                            <th scope="col">Nama Pengguna</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">No Tlp</th>
                                                            <th scope="col">OPD</th>

                                                            <th scope="col" style="width: 15%;text-align: center">Aksi
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($opd as $no => $user)
                                                        <tr>
                                                            <th scope="row" style="text-align: center">{{ ++$no}}</th>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                {{ $user->phone }}
                                                            </td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td class="text-center">
                                                                {{--  @can('users.edit')  --}}
                                                                <a href="/user/edit/{{$user->id}}"
                                                                    class="btn btn-xs btn-primary">
                                                                    <i class="fa fa-edit"> Ubah</i>
                                                                </a>
                                                                {{--  @endcan  --}}

                                                                {{--  @can('users.delete')  --}}
                                                                <button onClick="Delete(this.id)"
                                                                    class="btn btn-xs btn-danger" id="{{ $user->id }}">
                                                                    <i class="fa fa-trash"> Hapus</i>
                                                                </button>
                                                                {{--  @endcan  --}}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel"
                                        aria-labelledby="custom-tabs-three-messages-tab">

                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel"
                                        aria-labelledby="custom-tabs-three-settings-tab">
                                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis
                                        tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque
                                        tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum
                                        consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec
                                        pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam.
                                        Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst.
                                        Praesent imperdiet accumsan ex sit amet facilisis.
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    @endsection
