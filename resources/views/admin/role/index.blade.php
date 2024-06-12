@extends('layouts.blackand.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Role</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Role</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      @can('roles.create')
                        <h3 class="card-title">
                            <a href="/role/create"><i class="fa fa-plus"></i> </a>
                            Tambah Role
                        </h3>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center; width: 6%;">No.</th>
                                    <th scope="col" style="width: 15%;">Nama Role</th>
                                    <th scope="col">Permission</th>
                                    <th scope="col" style="width: 15%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $no => $role)
                                <tr>
                                    <th scope="row" style="text-align: center;">{{ ++$no }}</th>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            @foreach($role->getPermissionNames() as $permission)
                                            <button class="btn btn-sm btn-success m-1">{{ $permission }}</button>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                         @can('roles.edit') 
                                        <a href="/role/edit/{{ $role->id }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                         @endcan 
                                         @can('roles.delete') 
                                        {{--  <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $role->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>  --}}
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
