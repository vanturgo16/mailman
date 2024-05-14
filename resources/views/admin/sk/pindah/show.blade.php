<html moznomarginboxes mozdisallowselectionprint>
  
<head>
	<title>SURAT KETERANGAN BERDOMISILI</title>
</head>
<script>
    window.addEventListener("load", window.print());
  </script>
<body>
 
	<div class="container">
      
        
		<center class="logo">
            <img class="w-100" class="atas" src="{{asset ('blackend/img_sk/pindah.png') }}" alt="Image">
        </center>
        <div class="model">  

            <table>
                <tr>
                    <td>Provinsi</td>
                    <td>:</td>
                    <td>{{ $profil_desa->provinsi }}</td>
                </tr>
                <tr>
                    <td>Kabupaten/Kota</td>
                    <td>:</td>
                    <td>{{ $profil_desa->kota_kab }}</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td>{{ $profil_desa->kecamatan }}</td>
                </tr>
                <tr>
                    <td>Desa/Kelurahan</td>
                    <td>:</td>
                    <td>{{ $profil_desa->nm_desa }}</td>
                </tr>
            </table>
           
                
        </div>
        <center class="judul">
                         <h3> <u>  SURAT KETERANGAN PINDAH ATAU DATANG WNI</u></h3> <p></p>
                               Nomor : ……………………………………
		</center>
<div class="model">
        DATA DAERAH ASAL
    </div>
        <table class="table1">
            <tr>
                <td>1.	Nomor Kartu Keluarga</td>
                <td>:</td>
                <td>{{ $pindah->desa_asal }}</td>
                <td></td>
                <td></td>
                
            </tr>
            <tr>
                <td>2.	Nama Kepala Keluarga</td>
                <td>:</td>
                <td>{{ $pindah->nm_kk }}</td>
                <td></td>
                <td></td>
                
            </tr>
            <tr>
                <td>3.	Alamat</td>
                <td>:</td>
                <td>RT.{{ $pindah->rt_asal }}/RW.{{ $pindah->rt_asal }} Dusun {{ $pindah->desa_asal }}</td>
                <td></td>
                <td></td>
                
            </tr>
        </table>

        <table class="table2">
            <tr>
                <td>Provinsi</td>
                <td>:</td>
                <td>{{ $pindah->provinsi_asal }}</td>
                <td></td>
                <td></td>
                
            </tr>
            <tr>
                <td>Kab/Kota</td>
                <td>:</td>
                <td>{{ $pindah->kab_kota_asal }}</td>
                <td></td>
                <td></td>
                
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td>{{ $pindah->kec_asal }}</td>
                <td></td>
                <td></td>
                
            </tr>
            <tr>
                <td>Desa Kelurahan</td>
                <td>:</td>
                <td>{{ $pindah->desa_asal }}</td>
                <td></td>
                <td></td>
                
            </tr>
        </table>

        <div class="model">
            DATA KEPINDAHAN
        </div>
            <table class="table1">
                <tr>
                    <td>1.	Alasan Kepindahan</td>
                    <td>:</td>
                    <td>{{ $pindah->alasan_pindaj }}</td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td>2.	Alamat Tujuan Pindah</td>
                    <td>:</td>
                    <td>RT.{{ $pindah->rt_tujuan }}/RW.{{ $pindah->rt_tujuan }} : Dusun {{ $pindah->desa_tujuan }}</td>
                    <td></td>
                    <td></td>
                    
                </tr>
           
            </table>

            <table class="table2">
                <tr>
                    <td>Desa Kelurahan</td>
                    <td>:</td>
                    <td>{{ $pindah->desa_tujuan }}</td>
                    <td></td>
                    <td></td>
                    
                </tr>
                
                <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td>{{ $pindah->kec_tujuan }}</td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td>Kab/Kota</td>
                    <td>:</td>
                    <td>{{ $pindah->kab_kota_tujuan }}</td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>:</td>
                    <td>{{ $pindah->provinsi_tujuan }}</td>
                    <td></td>
                    <td></td>
                    
                </tr>
            </table>
          
            <br>
            <table class="table1">
                <tr>
                    <td>1.	Klasifikasi Pindah</td>
                    <td>:</td>
                    <td>{{ $pindah->kls_pindah }}</td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td>2.	Jenis Kepindahan</td>
                    <td>:</td>
                    <td>{{ $pindah->jns_pindah }}</td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td>3.	Status KK bagi yang tidak pindah</td>
                    <td>:</td>
                    <td>{{ $pindah->sts_kk_tdk_pindah }}</td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td>4.	Status KK yang Pindah</td>
                    <td>:</td>
                    <td>{{ $pindah->sts_kk_yg_pindah }}</td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td>5.	Keluarga yang pindah</td>
                    <td>:</td>
                    <td>{{ $pindah->jml }} Orang</td>
                    <td></td>
                    <td></td>
                    
                </tr>
           
            </table>
<br>
<br>
<center>
            <table class="data">
                <tr>
                    <th style="border: 1px solid">No</th>
                    <th style="border: 1px solid">Nama</th>
                    <th style="border: 1px solid">Tempat,Tanggal lahir</th>
                    <th style="border: 1px solid">JK</th>
                    <th style="border: 1px solid">Status Perkawinan</th>
                    <th style="border: 1px solid">Pekerjaan</th>
                    <th style="border: 1px solid">Ket</th>
                </tr>
                @foreach ($kk_pindah as  $no =>$kk)
                    
              
                <tr>
                    <td style="border: 1px solid"> <center>{{ ++$no }}.</center></td>
                    <td style="border: 1px solid">{{ $kk->nama }}</td>
                    <td style="border: 1px solid">{{ $kk->tempat }},{{ $kk->tgl }}</td>
                    <td style="border: 1px solid">
                        <center> {{ $kk->jk }}</center></td>
                    <td style="border: 1px solid"><center>{{ $kk->status_kawin }}</center></td>
                    <td style="border: 1px solid">{{ $kk->pekerjaan }}</td>
                    <td style="border: 1px solid"></td>
                </tr>
                @endforeach
            </table>
        </center>
<br>
<br>
<br>
        <table style="width:80%"; class="ttd">
            <tr>
                <td style="width: 43%">  Pemohon </td>
                <td>  @php
                    $tgl = date ('Y-m-d');
                    @endphp
                    Dikeluarkan  Di	: Randau Jungkal<p>
                    Pada Tanggal	: {{hari_ini()}},
                    {{ dateIndonesia($tgl) }}<p>
                    Kepala Desa Randau Jungkal</td>
            </tr>
        </table>
        
         <br><br><br>
        
        <table style="width:80%"; class="ttd1">
            <tr>
                <td> <b> {{ $pemohon->nama }} </b></td>
                <td><b><u>{{ $sambutan->nm_kep }} </u></b></td>
            </tr>
        </table>
<style>
    .logo{
        margin-left: 2%;
        margin-right: 2%;
        margin-top: 1%;
    }
    .model{
        text-align: left;
        margin-right: 4%;
        margin-left: 10%;
        
    }
    .table1{
        margin-left: 15%;
        margin-right: 4%
    }
    .table2{
        margin-left: 40%;
        margin-right: 4%
    }
    .table3{
        margin-left: 7%;
        margin-right: 4%
    }
    .data{
        margin-left: 2%;
        border: 1px ridge;
        width: 90%;
        border-collapse: collapse;
    }
    .td{
        border: 1px solid rgb(31, 14, 14);
    }
  
    .ttd{
        margin-left: 20%;
        padding-bottom: 8%;
        line-height: 0.7%;
     }
     .ttd1{
         margin-left: 17%;
        
      }
    .bawah{
       
        padding-top: 35%;
    }
</style>