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
            <img class="w-100" class="atas" src="{{asset ('blackend/img_sk/menikah.png') }}" alt="Image">
        </center>
        <div class="model">  Model N1 </div>
        <center class="judul">
                         <h3> <u>  SURAT PENGANTAR PERKAWINAN</u></h3> <p></p>
                               Nomor : ……………………………………
		</center>
<div class="judul"> Yang bertanda tagan dibawah ini, menerangkan dengan sesungguhnya bahwa:</div>      
<table class="table1">
    <tr>
        <td>1.</td>
        <td style="width:32%";>Nama Lengkap/Alias</td>
        <td>:</td>
        <td><b>{{ $menikah->nama_anak }}</b></td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Nomor Induk Kependudukan</td>
        <td>:</td>
        <td>{{ $menikah->nik_anak }}</td>
    </tr>
    <tr>
        <td>3.</td>
        <td>Jenis kelamin</td>
        <td>:</td>
        <td>
            @if ($menikah->jk_anak == "L")
            <span>Laki-Laki</label>

            @elseif($menikah->jk_anak == "P")
            <span>Perempuan</label>
                
          @endif 
        </td>
    </tr>
    <tr>
        <td>4.</td>
        <td>Tempat dan Tanggal Lahir</td>
        <td>:</td>
        <td>{{ $menikah->tempat_anak }}, {{ $menikah->tgl_anak }}</td>
    </tr>
    <tr>
        <td>5.</td>
        <td>Kewarganegaraan</td>
        <td>:</td>
        <td>{{ $menikah->negara_anak }}</td>
    </tr>
    <tr>
        <td>6.</td>
        <td>Agama	</td>
        <td>:</td>
        <td>
            @if ($menikah->agama_anak == 1)
            <span>Islam</label>
                @elseif($menikah->agama_anak == 2)
                <span>Kristen</label>
                    @elseif($menikah->agama_anak == 3)
                    <span>Hindu</label>
                        @elseif($menikah->agama_anak == 4)
                        <span>Buddha</label>
                            @elseif($menikah->agama_anak == 5)
                            <span>Konghucu</label>
                        
              @endif
        </td>
    </tr>
    <tr>
        <td>7.</td>
        <td>Pekerjaan</td>
        <td>:</td>
        <td>{{ $menikah->pekerjaan_anak }}</td>
    </tr>
    <tr>
        <td>8.</td>
        <td>Alamat</td>
        <td style="vertical-align: top">:</td>
        <td style="vertical-align: top">{{ $menikah->alamat_anak }}</td>
    </tr>
    <tr>
        <td>9.</td>
        <td>Status Perkawinan</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>
            a.	Laki-laki : Jejaka, Duda <br>
            atau beristri ke {{ $menikah->istri_ke }}
            </td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>b.	Perempuan, Perawan, Janda	
            </td>
        <td>:</td>
        <td>{{ $menikah->status_kawin_p }}</td>
    </tr>
    <tr>
        <td>10.</td>
        <td>Nama Suami/Istri terdahulu</td>
        <td>:</td>
        <td>{{ $menikah->nm_suami_atau_istri }}</td>
    </tr>
</table>

<div class="judul1">Adalah benar anak dari perkawinan seorang pria :</div>
<table class="table2">
    <tr>
        <tr>
            
            <td style="width:35%";>Nama lengkap dan alias</td>
            <td>:</td>
            <td><b>{{ $menikah->nama_ayah }}</b></td>
        </tr>
        <tr>
          
            <td>Bin</td>
            <td>:</td>
            <td>{{ $menikah->bin_ayah }}</td>
        </tr>
        <tr>
          
            <td>Nomor Induk Kependudukan (NIK)</td>
            <td>:</td>
            <td>{{ $menikah->nik_ayah }}</td>
        </tr>
        <tr>
            
            <td>Tempat dan tanggal Lahir</td>
            <td>:</td>
            <td>{{ $menikah->tempat_ayah }}, {{ $menikah->tgl_ayah }}</td>
        </tr>
        <tr>
          
            <td>Kewarganegaraan</td>
            <td>:</td>
            <td>{{ $menikah->negara_ayah }}</td>
        </tr>
        <tr>
           
            <td>Agama</td>
            <td>:</td>
            <td>
                @if ($menikah->agama_ayah == 1)
                <span>Islam</label>
                    @elseif($menikah->agama_ayah == 2)
                    <span>Kristen</label>
                        @elseif($menikah->agama_ayah == 3)
                        <span>Hindu</label>
                            @elseif($menikah->agama_ayah == 4)
                            <span>Buddha</label>
                                @elseif($menikah->agama_ayah == 5)
                                <span>Konghucu</label>
                            
                  @endif
                </td>
        </tr>
        <tr>
           
            <td>Alamat</td>
            <td  style="vertical-align: top">:</td>
            <td  style="vertical-align: top">{{ $menikah->alamat_ayah }}</td>
        </tr>
    
</table>

<div class="judul1">Dengan seorang wanita :</div>
<table class="table3">
    <tr>
            
        <td style="width:35%";>Nama lengkap dan alias</td>
        <td>:</td>
        <td><b>{{ $menikah->nama_ibu }}</b></td>
    </tr>
    <tr>
      
        <td>Bin</td>
        <td>:</td>
        <td>{{ $menikah->bin_ibu }}</td>
    </tr>
    <tr>
      
        <td>Nomor Induk Kependudukan (NIK)</td>
        <td>:</td>
        <td>{{ $menikah->nik_ibu }}</td>
    </tr>
    <tr>
        
        <td>Tempat dan tanggal Lahir</td>
        <td>:</td>
        <td>{{ $menikah->tempat_ibu }}, {{ $menikah->tgl_ibu }}</td>
    </tr>
    <tr>
      
        <td>Kewarganegaraan</td>
        <td>:</td>
        <td>{{ $menikah->negara_ibu }}</td>
    </tr>
    <tr>
       
        <td>Agama</td>
        <td>:</td>
        <td>
            @if ($menikah->agama_ibu == 1)
            <span>Islam</label>
                @elseif($menikah->agama_ibu == 2)
                <span>Kristen</label>
                    @elseif($menikah->agama_ibu == 3)
                    <span>Hindu</label>
                        @elseif($menikah->agama_ibu == 4)
                        <span>Buddha</label>
                            @elseif($menikah->agama_ibu == 5)
                            <span>Konghucu</label>
                        
              @endif
        </td>
    </tr>
    <tr>
       
        <td>Alamat</td>
        <td  style="vertical-align: top">:</td>
        <td  style="vertical-align: top">{{ $menikah->alamat_ibu }}</td>
    </tr>
</table>


<div class="ttd">
    @php
    $tgl = date ('Y-m-d');
    @endphp
    Dikeluarkan  Di	: Randau Jungkal<p>
    Pada Tanggal	: {{hari_ini()}},
    {{ dateIndonesia($tgl) }}<p>
    Kepala Desa Randau Jungkal<p>

       
   <h4 class="bawah"><u> {{ $sambutan->nm_kep }}</u></h4>
    </div>



<br/>


<style>
    .logo{
        margin-left: 2%;
        margin-right: 2%;
        margin-top: 1%;
    }
    .model{
        text-align: right;
        margin-right: 4%;
        font-weight: bold;
    }
    .table1{
        margin-left: 7%;
        margin-right: 4%
    }
    .table2{
        margin-left: 7%;
        margin-right: 4%
    }
    .table3{
        margin-left: 7%;
        margin-right: 4%
    }
    .judul{
        margin-left: 4%;
        margin-top: 2%;
        margin-bottom: 2%;
    }
    .judul1{
        margin-left: 7%;
        margin-top: 1%;
        margin-bottom: 1%;

    }
    .ttd{
        peding-right: 2%;
        text-align: left;
        margin-left:60%;
        line-height: 0.7%;
        padding-top: 3%
    }
    .bawah{
       
        padding-top: 35%;
    }
</style>