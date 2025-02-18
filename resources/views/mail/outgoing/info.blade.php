@extends('layouts.blackand.appother')
@section('content')

@include('mail.head')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><span class="mdi mdi-information"></span> Informasi Surat Keluar | 
                    @if($data->mail_number == null)
                    <span class="badge bg-warning"><i class="fas fa-spinner"></i> Menunggu..</span>
                    @else
                    <b>({{ $data->mail_number }})</b>
                    @endif
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('outgoingmail.index') }}"> Daftar Surat Keluar</a></li>
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
            <div class="card p-3" style="background-color:rgb(240, 240, 240);">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div><span class="text-bold">Nomor Naskah :</span></div>
                            <span>
                                @if($data->mail_number == null)
                                <span class="badge bg-warning"><i class="fas fa-spinner"></i> Menunggu..</span>
                                @else
                                {{ $data->mail_number }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div><span class="text-bold">Jenis Naskah :</span></div>
                            <span>
                                @if($data->let_name == null)
                                    <span class="badge bg-secondary">Tidak Diisi..</span>
                                @else
                                    {{ $data->let_name }}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div><span class="text-bold">KKA Type :</span></div>
                            <span>
                                @if($kka_type == null)
                                    <span class="badge bg-secondary">-</span>
                                @else
                                    <b>{{ $kka_type->kka_primary_code }}</b> - {{ $kka_type->kka_type }}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div><span class="text-bold">KKA Code :</span></div>
                            <span>
                                @if($kka_codes == null)
                                    <span class="badge bg-secondary">-</span>
                                @else
                                    <b>{{ $kka_codes->kka_code }}</b> - {{ $kka_codes->kka_desc }}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div><span class="text-bold">Konseptor :</span></div>
                            <span>
                                @if($data->drafter_name == null)
                                    <span class="badge bg-secondary">Tidak Diisi..</span>
                                @else
                                    {{ $data->drafter_name }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
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
                </div>
            </div>
        
            <hr>
            <div class="row px-2">
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
                        <div><span class="text-bold">Tanggal Keluar :</span></div>
                        <span>
                            @if($data->out_date == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->out_date }}
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
                        <div><span class="text-bold">Penanda Tangan :</span></div>
                        <span>
                            @if($data->sign_name == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->sign_name }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div><span class="text-bold">Penanda Tangan Pihak Instansi Lain :</span></div>
                        <div class="card p-2 mt-1" style="background-color:rgb(253, 253, 253);">
                            @if($data->signing_other == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {!! $data->signing_other !!}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <div><span class="text-bold">Penerima :</span></div>
                        <div class="card p-2 mt-1" style="background-color:rgb(253, 253, 253);">
                            @if($data->receiver == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {!! $data->receiver !!}
                            @endif
                        </div>
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
                        <div><span class="text-bold">Arsip Pertinggal :</span></div>
                        <span>
                            @if($data->archive_remains == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->archive_remains }}
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
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Nomor Referensi :</span></div>
                        <span>
                            @if($data->ref_number == null)
                                <span class="badge bg-secondary">Tidak Diisi..</span>
                            @else
                                {{ $data->ref_number }}
                            @endif
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <div><span class="text-bold">Lampiran :</span></div>
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
                <form action="{{ route('outgoingmail.index.post') }}" method="POST" id="resetForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="out_date" value="{{ request()->get('out_date') }}">
                    <input type="hidden" name="mail_date" value="{{ request()->get('mail_date') }}">
                    <input type="hidden" name="mail_number" value="{{ request()->get('mail_number') }}">
                    <input type="hidden" name="id_mst_letter" value="{{ request()->get('id_mst_letter') }}">
                    <input type="hidden" name="archive_remain" value="{{ request()->get('archive_remain') }}">
                    <input type="hidden" name="org_unit" value="{{ request()->get('org_unit') }}">
                    <input type="hidden" name="idUpdated" value="{{ $id }}">
                    <button type="submit" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Kembali </button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection