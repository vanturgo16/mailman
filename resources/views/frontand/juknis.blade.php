@extends('layouts.frontand.app')
@section('content')
    <div class="page-wrapper">
        <!-- start of breadcumb-section -->
        <div class="wpo-breadcumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wpo-breadcumb-wrap">
                            <h2>Juknis</h2>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span>Juknis</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of wpo-breadcumb-section-->

        <!-- start wpo-contact-pg-section -->
        <div class="cart-area section-padding">
            <div class="container">
                <div class="form">
                    <div class="cart-wrapper">
                        <div class="row">
                            <div class="col-12">
                              

                                <div class="table-container">
                                    <table class="table">
                                        {{--  <h3 class="text-center">Tabel Responsive 1</h3>
                                        <caption>Tabel responsive dengan container</caption>  --}}
                                        <thead>
                                            <tr>
                                                {{--  <th>No</th>  --}}
                                                <th>Keterangan</th>
                                                <th>Tanggal Upload</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($juknis as $j)
                                                <tr>
                                                    {{--  <td>{{ $loop->iteration }}</td>  --}}
                                                    <td><a href="{{ asset('storage/juknis/' . $j->nm_file) }}"
                                                            target="blank">{{ $j->judul_file }}</a></td>
                                                    <td>{{ dateIndonesia(date('Y-m-d', strtotime($j->created_at))) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">Tidak ada juknis</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            {{ $juknis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end wpo-contact-pg-section -->
    @endsection
