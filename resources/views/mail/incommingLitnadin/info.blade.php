@extends('layouts.blackand.appother')
@section('content')

@include('mail.head')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><span class="mdi mdi-information"></span> Informasi Surat Masuk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('incommingmail.indexLitnadin') }}"> Daftar Surat Masuk (Litnadin)</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                Detail Informasi
            </h3>
        </div>
        <div class="card-body" style="max-height: 55vh; overflow-y: auto;">
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
                        <div><span class="text-bold">Kode Satuan Organisasi (Sub) :</span></div>
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
                        <div><span class="text-bold">Perihal / Tentang :</span></div>
                        <div class="card p-2 mt-1" style="background-color:rgb(253, 253, 253);">
                            @if($data->mail_regarding == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {!! $data->mail_regarding !!}
                            @endif
                        </div>
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
                            <div><span class="text-bold">Penandatangan :</span></div>
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
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Jumlah Lampiran :</span></div>
                        <div class="card p-2 mt-1" style="background-color:rgb(253, 253, 253);">
                            @if($data->attachment_text == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {!! $data->attachment_text !!}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div><span class="text-bold">Keterangan :</span></div>
                        <div class="card p-2 mt-1" style="background-color:rgb(253, 253, 253);">
                            @if($data->information == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {!! $data->information !!}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                <div class="form-group">
                    <div><span class="text-bold">Status :</span></div>
                    <span>
                        @if($data->status == 1)
                            <span class="badge bg-success text-white">Selesai</span>
                        @elseif($data->status == 0) 
                            <span class="badge bg-warning text-white">Revisi</span></div>
                        @else
                            <span class="badge bg-secondary text-white">Null</span></div>
                        @endif
                    </span>
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
                            <b>{{ $data->updated_by }}</b>
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
                    <form action="{{ route('incommingmail.indexLitnadin.post') }}" method="POST" id="resetForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="entry_date" value="{{ request()->get('entry_date') }}">
                        <input type="hidden" name="mail_date" value="{{ request()->get('mail_date') }}">
                        <input type="hidden" name="mail_number" value="{{ request()->get('mail_number') }}">
                        <input type="hidden" name="litnadin_number" value="{{ request()->get('litnadin_number') }}">
                        <input type="hidden" name="org_unit" value="{{ request()->get('org_unit') }}">
                        <input type="hidden" name="letter" value="{{ request()->get('letter') }}">
                        <input type="hidden" name="jmlHal" value="{{ request()->get('jmlHal') }}">
                        <input type="hidden" name="status" value="{{ request()->get('status') }}">
                        <input type="hidden" name="idUpdated" value="{{ $id }}">
                        <button type="submit" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Kembali </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection