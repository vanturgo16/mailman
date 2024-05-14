@extends('layouts.blackand.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Galeri</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Data Galeri</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                aria-selected="true">Photo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile"
                                aria-selected="false">Video</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                            aria-labelledby="custom-tabs-one-home-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <a href="/data-gallery/create"><i class="fa fa-plus"></i> </a>
                                        Tambah Galeri
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">

                                    <table id="example1"class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="text-align: center;width: 6%">No.</th>

                                                <th scope="col">Gambar</th>
                                                <th scope="col">Operator</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($gallery as $no => $gallery)
                                                <tr>
                                                    <th scope="row" style="text-align: center">{{ ++$no }}</th>

                                                    <td>
                                                        <center>
                                                            <img src="{{ Storage::url('public/gallery/' . $gallery->image) }}"
                                                                style="width: 100px">

                                                        </center>
                                                    </td>

                                                    <td>{{ $gallery->operator }}</td>
                                                    <td>{{ $gallery->updated_at }}</td>

                                                    <td class="text-center">


                                                        {{--  @can('users.delete')  --}}
                                                        <form method="POST" class="d-inline"
                                                            onsubmit="return confirm('Masukan ke tempat sampah?')"
                                                            action="/data-gallery/{{ $gallery->id }}/destroy">
                                                            @csrf
                                                            <input type="hidden" value="DELETE" name="_method">
                                                            <button type="submit" value="Delete"
                                                                class="btn btn-xs btn-danger">
                                                                <i class="fas fa-trash"></i> Hapus</button>
                                                        </form>
                                                        {{--  @endcan  --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                            aria-labelledby="custom-tabs-one-profile-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <a href="/data-gallery/create"><i class="fa fa-plus"></i> </a>
                                        Tambah Galeri
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example3"class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="text-align: center;width: 6%">No.</th>

                                                <th scope="col" width="30%">Video</th>
                                                <th scope="col">Operator</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($video as $no => $video)
                                                <tr>
                                                    <th scope="row" style="text-align: center">{{ ++$no }}</th>

                                                    <td>
                                                        <iframe width="240"
                                                            src="https://www.youtube.com/embed/{{ $video->video }}"
                                                            title="{{ $video->keterangan }}" frameborder="0">
                                                        </iframe>

                                                       

                                                    </td>

                                                    <td>{{ $video->operator }}</td>
                                                    <td>{{ $video->updated_at }}</td>

                                                    <td class="text-center">


                                                        {{--  @can('users.delete')  --}}
                                                        <form method="POST" class="d-inline"
                                                            onsubmit="return confirm('Masukan ke tempat sampah?')"
                                                            action="/data-gallery/{{ $video->id }}/destroy_video">
                                                            @csrf
                                                            <input type="hidden" value="DELETE" name="_method">
                                                            <button type="submit" value="Delete"
                                                                class="btn btn-xs btn-danger">
                                                                <i class="fas fa-trash"></i> Hapus</button>
                                                        </form>
                                                        {{--  @endcan  --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
