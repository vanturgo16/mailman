@extends('layouts.blackand.app')

@section('content')
<style>
    .hidden {
        display: none;
    }
</style>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-building"></i> Informasi Penomoran Dokumen</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Informasi Penomoran Dokumen</li>
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
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="card">
                                        <!-- Form Pattern-->
                                    <form action="{{ url('pattern/store/'. $data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="card-body">
                                            <!-- Notifikasi menggunakan flash session data -->
                                            @if (session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @endif
    
                                            @if (session('fail'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('fail') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @endif
                                            <input type="hidden" name="let_id" value="{{ decrypt($id) }}">
                                            <div class="form-group">
                                                <label class="text-danger">Kode Naskah Dinas*</label>
                                                <input type="text" class="form-control" id="" name="kode_naskah" value="{{ $data->let_code }}" readonly required>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-danger">Nama Naskah Dinas*</label>
                                                <input type="text" class="form-control" id="" name="nama_naskah" value="{{ $data->let_name }}" readonly required>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="text-danger">Tipe Penomoran* {{ $data->pat_type }}</label>
                                                <select class="form-control" id="kategori" name="kategori" required>
                                                    <option value="">-- Pilih Tipe --</option>
                                                    @foreach ($dropdowns as $dropdown)
                                                        <option value="{{ $dropdown->name_value }}" 
                                                            @if ($dropdown->name_value == $data->pat_type)
                                                                selected
                                                            @endif
                                                        >{{ $dropdown->name_value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group hidden" id="pat_simple">
                                                <label class="text-danger">Struktur Nomor*</label>
                                                <input type="text" class="form-control" id="pat_simple_input" name="pat_simple" value="{!! $data->pat_simple !!}">
                                                <label for="">
                                                    <span>
                                                        Tanda Kutip (') untuk string. Contoh : 'String'
                                                        <br>
                                                        Tanda Kress (#) untuk tanggal, bulan, tahun. Contoh : #MM#DD#YYYY = 03012008
                                                        <br>
                                                        Tanda (@) untuk format autonumber
                                                        <br>
                                                        Tanda ({}) untuk format banyak digit pada autonumber. Contoh : @{5} = 00001, 00002
                                                        <br>
                                                        Tanda (^) untuk format angka dalam bilangan Romawi. Dipadupadankan dengan tanda yang lain. Contoh : #^MM = III, @{^21} = XXI
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="form-group hidden" id="pat_mix">
                                                <label class="text-danger">Struktur Nomor*</label>
                                                <table class="form-group form-inline table table-borderless" id="table">
                                                    @if (!empty($data->pat_mix))
                                                        @foreach (json_decode($data->pat_mix) as $index => $item)
                                                            @if($index % 4 == 0)
                                                                @if($index > 0)
                                                                    </tr> <!-- Close the previous row -->
                                                                @endif
                                                                <tr> <!-- Start a new row -->
                                                            @endif
                                                            <td>
                                                                <select class="form-control pat_mix_type" id="pat_mix_type" name="pat_mix[]" required>
                                                                    <option value="">-- Pilih Tipe --</option>
                                                                    @foreach ($strucNos as $strucNo)
                                                                        <option value="{{ $strucNo->name_value }}" {{ $strucNo->name_value == $item ? 'selected' : '' }}>
                                                                            {{ $strucNo->name_value }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if($index > 0)
                                                                    <button type="button" class="btn btn-danger removeStructure"><i class="fas fa-minus"></i></button>
                                                                @else
                                                                    <button type="button" id="addStructure" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                
                                                        @if(count(json_decode($data->pat_mix)) % 4 != 0)
                                                            </tr> <!-- Close the last row if it wasn't already closed -->
                                                        @endif
                                                    @else    
                                                        <td>
                                                            <select class="form-control pat_mix_type" id="pat_mix_type" name="pat_mix[]" required>
                                                                <option value="">-- Pilih Tipe --</option>
                                                                @foreach ($strucNos as $strucNo)
                                                                    <option value="{{ $strucNo->name_value }}">{{ $strucNo->name_value }}</option>
                                                                @endforeach
                                                            </select>
                                                            <button type="button" id="addStructure" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                                        </td>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const dropdown = document.getElementById('kategori');

            // Function to show/hide elements based on selected value
            function updateForm() {
                const value = dropdown.value;
                const pat_simple = document.getElementById('pat_simple');
                const pat_simple_input = document.getElementById('pat_simple_input');
                const pat_mix = document.getElementById('pat_mix');

                // Hide all divs and remove required attribute
                pat_simple.classList.add('hidden');
                pat_simple_input.required = false;
                pat_mix.classList.add('hidden');
                $('.pat_mix_type').removeAttr('required');

                // Show the selected div and add required attribute to the appropriate input
                if (value === 'Sederhana') {
                    pat_simple.classList.remove('hidden');
                    pat_simple_input.required = true;
                } else if (value === 'Perpaduan') {
                    pat_mix.classList.remove('hidden');
                }
            }

            // Function to add a new row to pat_mix
            function addPatMixRow(value = "") {
                const newStructure = `
                    <tr>
                        <td>
                            <select class="form-control pat_mix_type" name="pat_mix[]" required>
                                <option value="">-- Pilih Tipe --</option>
                                @foreach ($strucNos as $strucNo)
                                    <option value="{{ $strucNo->name_value }}" ${value === "{{ $strucNo->name_value }}" ? 'selected' : ''}>
                                        {{ $strucNo->name_value }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-danger removeStructure"><i class="fas fa-minus"></i></button>
                        </td>
                    </tr>
                `;
                $('#table').append(newStructure);
            }

            // Run the updateForm function when the dropdown value changes
            dropdown.addEventListener('change', updateForm);

            // Call updateForm on page load to show the correct elements
            updateForm();

            // Add Structure Nomor
            $('#addStructure').click(function () {
                addPatMixRow();
            });

            // Remove Structure Nomor
            $(document).on('click', '.removeStructure', function () {
                $(this).parent().remove();
            });
        });
    </script>
    @endsection
