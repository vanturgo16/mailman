@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Pengguna</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Pengguna</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="/user/create"><i class="fa fa-plus"></i> </a>
                            Tambah Data Administrator
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center; width: 6%;">No.</th>
                                    <th scope="col">Nama Pengguna</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No Tlp</th>
                                    <th scope="col">Role</th>
                                    <th scope="col" style="width: 15%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $no => $user)
                                <tr>
                                    <th scope="row" style="text-align: center;">{{ ++$no }}</th>
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
                                        @can('user.edit') 
                                        <a href="/user/edit/{{ $user->id }}" class="btn btn-xs btn-primary">
                                            <i class="fa fa-edit"> Ubah</i>
                                        </a>
                                        @endcan 
                                        @can('user.delete') 
                                        <button onClick="Delete(this.id)" class="btn btn-xs btn-danger" id="{{ $user->id }}">
                                            <i class="fa fa-trash"> Hapus</i>
                                        </button>
                                        @endcan 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>       
        </div>
    </div>
</div>
@endsection
