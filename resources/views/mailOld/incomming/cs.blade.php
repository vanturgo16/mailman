@extends('layouts.blackand.app')

{{-- Jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-envelope"></i> Daftar Surat Masuk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Surat Masuk</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card p-4">
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
              <td align="center">
                <img src="{{ asset('/img/sdgdibngn.png') }}" alt="" width="20%">
                <br>
                <br>
                <h4 class="text-bold">Segera Dibangun..</h4>
              </td>
            </tr>
        </table>
    </div>
</div>

@endsection
