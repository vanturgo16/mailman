@extends('layouts.blackand.appother')
@section('content')

@include('mail.head')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><span class="mdi mdi-information"></span> Informasi Surat Masuk | 
                    @if($data->mail_number == null)
                    <span class="badge bg-secondary">Nomor Surat Kosong</span>
                    @else
                    <b>({{ $data->mail_number }})</b>
                    @endif
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('incommingmail.index') }}"> Daftar Surat Masuk</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header"><h3 class="card-title"></h3></div>
        <div class="card-body" style="max-height: 58vh; overflow-y: auto;">
            <div class="row px-2">
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Pejabat / Naskah :</span></div>
                        <span>
                            @if($data->placeman == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->placeman }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Kode Satuan Organisasi (Induk) :</span></div>
                        <span>
                            @if($data->sator_name == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->sator_name }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Kode Satuan Organisasi (Sub) / Konseptor :</span></div>
                        <span>
                            @if($data->sub_sator_name == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->sub_sator_name }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        @if($data->placeman == "PENGADUAN")
                            <div><span class="text-bold">Jenis Pengaduan :</span></div>
                            <span>
                                @if($data->com_name == null)
                                    <span class="badge bg-secondary">Tidak Diisi..</span>
                                @else
                                    {{ $data->com_name }}
                                @endif
                            </span>
                        @else
                            <div><span class="text-bold">Jenis Naskah :</span></div>
                            <span>
                                @if($data->let_name == null)
                                    <span class="badge bg-secondary">Tidak Diisi..</span>
                                @else
                                    {{ $data->let_name }}
                                @endif
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Pengirim :</span></div>
                        <span>
                            @if($data->sender == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->sender }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        @if($data->placeman == "PENGADUAN")
                            <div><span class="text-bold">Nomor Surat Pengaduan :</span></div>
                        @else
                            <div><span class="text-bold">Nomor Surat :</span></div>
                        @endif
                        <span>
                            @if($data->mail_number == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->mail_number }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div><span class="text-bold">Hal / Tentang :</span></div>
                        @if($data->mail_regarding == null)
                            <span class="badge bg-secondary">Tidak Diisi..</span>
                        @else
                            <div class="card p-2 mt-1" style="background-color:rgb(253, 253, 253);">
                                {!! $data->mail_regarding !!}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Tanggal Masuk :</span></div>
                        <span>
                            @if($data->entry_date == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->entry_date }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Tanggal Surat :</span></div>
                        <span>
                            @if($data->mail_date == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->mail_date }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        @if($data->placeman == "PENGADUAN")
                            <div><span class="text-bold">Penandatanganan :</span></div>
                        @else
                            <div><span class="text-bold">Penerima :</span></div>
                        @endif
                        <span>
                            @if($data->receiver_name == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->receiver_name }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Jumlah :</span></div>
                        <span>
                            @if($data->mail_quantity == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->mail_quantity }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Satuan :</span></div>
                        <span>
                            @if($data->unit_name == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->unit_name }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Klasifikasi Arsip :</span></div>
                        <span>
                            @if($data->classification_name == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->classification_name }}
                            @endif
                        </span>
                    </div>
                </div>
                {{-- <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Retensi Surat (Dari) :</span></div>
                        <span>
                            @if($data->mail_retention_from == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->mail_retention_from }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Retensi Surat (Hingga) :</span></div>
                        <span>
                            @if($data->mail_retention_to == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->mail_retention_to }}
                            @endif
                        </span>
                    </div>
                </div> --}}
                @if($data->placeman == "LITNADIN")
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div><span class="text-bold">Hasil Penelitian :</span></div>
                            <span>
                                @if($data->result == null)
                                    <span class="badge bg-secondary">Tidak Diisi..</span>
                                @else
                                    {{ $data->result }}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div><span class="text-bold">Disetujui Oleh :</span></div>
                            <span>
                                @if($data->approved_by == null)
                                    <span class="badge bg-secondary">Tidak Diisi..</span>
                                @else
                                    {{ $data->approved_by }}
                                @endif
                            </span>
                        </div>
                    </div>
                @else
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div><span class="text-bold">Jenis Surat :</span></div>
                            <span>
                                @if($data->mail_type == null)
                                    <span class="badge bg-secondary">Tidak Diisi..</span>
                                @else
                                    {{ $data->mail_type }}
                                @endif
                            </span>
                        </div>
                    </div>
                @endif
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Diterima Via :</span></div>
                        <span>
                            @if($data->received_via == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->received_via }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="row px-2">
                <div class="col-lg-12">
                    <div class="form-group">
                        <div><span class="text-bold">Lampiran :</span></div>
                        @if($data->attachment_text == null)
                            <span class="badge bg-secondary">Tidak Diisi..</span>
                        @else
                            <div class="card p-2 mt-1" style="background-color:rgb(253, 253, 253);">
                                {!! $data->attachment_text !!}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div><span class="text-bold">Keterangan :</span></div>
                        @if($data->information == null)
                            <span class="badge bg-secondary">Tidak Diisi..</span>
                        @else
                            <div class="card p-2 mt-1" style="background-color:rgb(253, 253, 253);">
                                {!! $data->information !!}
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-6">
                <div class="form-group">
                    <div><span class="text-bold">Dibuat Oleh :</span></div>
                    <span>
                        <b>{{ $data->created_by }}</b>
                        <br>{{ $data->created_at }}
                    </span>
                </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div><span class="text-bold">Terakhir Diubah Oleh :</span></div>
                        <span>
                            @if($data->updated_by == null)
                                <span class="badge bg-secondary">Belum Ada..</span>
                            @else
                            <b>{{ $data->created_by }}</b>
                            <br>{{ $data->updated_at }}
                            @endif
                        </span>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer">
            <div class="row">
            <div class="col-12" style="text-align: right">
                <a href="{{ route('incommingmail.index') }}" type="button" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection