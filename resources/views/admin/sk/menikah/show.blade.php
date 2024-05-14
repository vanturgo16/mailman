

<table class="header">
  
    <tr>
        <td style="width:60%";>KANTOR DESA	</td>
        <td>:</td>
        <td>RANDAU JUNGKAL</td>
    </tr>
    <tr>
        <td>KECAMATAN </td>
        <td>:</td>
        <td>SANDAI</td>
    </tr>
    <tr>
        <td>KABUPATEN </td>
        <td>:</td>
        <td>KETAPANG</td>
    </tr>

</table>
<hr size="5px" color="#000000" >
<center>
<b><u> SURAT IZIN ORANG TUA </u></b> <br>
NOMOR : 474.2 /             / 2022 / Pem
</center>

<div class="judul"> Yang bertanda tangan dibawah ini :</div>
<table class="data">
       
    <tr>
        <td style="width:5%";>A</td>
        <td style="width:40%";>1. Nama lengkap dan alias</td>
        <td>:</td>
        <td><b>{{ $menikah->nama_ayah }}</b></td>
    </tr>
    <tr>
        <td></td>
        <td>2. Bin</td>
        <td>:</td>
        <td>{{ $menikah->bin_ayah }}</td>
    </tr>
    <tr>
        <td></td>
        <td>3. Nomor Induk Kependudukan (NIK)</td>
        <td>:</td>
        <td>{{ $menikah->nik_ayah }}</td>
    </tr>
    <tr>
        <td></td>
        <td>4. Tempat dan tanggal Lahir</td>
        <td>:</td>
        <td>{{ $menikah->tempat_ayah }}, {{ $menikah->tgl_ayah }}</td>
    </tr>
    <tr>
        <td></td>
        <td>5. Kewarganegaraan</td>
        <td>:</td>
        <td>{{ $menikah->negara_ayah }}</td>
    </tr>
    <tr>
        <td></td>
        <td>6. Agama</td>
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
        <td></td>
        <td>7. Alamat</td>
        <td  style="vertical-align: top">:</td>
        <td  style="vertical-align: top">{{ $menikah->alamat_ayah }}</td>
    </tr>

</table>

<table class="data">
       
    <tr>
        <td style="width:5%";>B</td>
        <td style="width:40%";>1. Nama lengkap dan alias</td>
        <td>:</td>
        <td><b>{{ $menikah->nama_ibu }}</b></td>
    </tr>
    <tr>
        <td></td>
        <td>2. Bin</td>
        <td>:</td>
        <td>{{ $menikah->bin_ibu }}</td>
    </tr>
    <tr>
        <td></td>
        <td>3. Nomor Induk Kependudukan (NIK)</td>
        <td>:</td>
        <td>{{ $menikah->nik_ibu }}</td>
    </tr>
    <tr>
        <td></td>
        <td>4. Tempat dan tanggal Lahir</td>
        <td>:</td>
        <td>{{ $menikah->tempat_ibu }}, {{ $menikah->tgl_ibu }}</td>
    </tr>
    <tr>
        <td></td>
        <td>5. Kewarganegaraan</td>
        <td>:</td>
        <td>{{ $menikah->negara_ibu }}</td>
    </tr>
    <tr>
        <td></td>
        <td>6. Agama</td>
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
        <td></td>
        <td>7. Alamat</td>
        <td style="vertical-align: top">:</td>
        <td style="vertical-align: top">{{ $menikah->alamat_ibu }}</td>
    </tr>

</table>

<div class="judul">Adalah benar ayah kandung dan ibu kandung dari seorang :</div>
<table class="data">
       
    <tr>
        <td style="width:5%";></td>
        <td style="width:40%";>1. Nama lengkap dan alias</td>
        <td>:</td>
        <td><b>{{ $menikah->nama_anak }}</b></td>
    </tr>
    <tr>
        <td></td>
        <td>2. Bin</td>
        <td>:</td>
        <td>{{ $menikah->bin_anak }}</td>
    </tr>
    <tr>
        <td></td>
        <td>3. Nomor Induk Kependudukan (NIK)</td>
        <td>:</td>
        <td>{{ $menikah->nik_anak }}</td>
    </tr>
    <tr>
        <td></td>
        <td>4. Tempat dan tanggal Lahir</td>
        <td>:</td>
        <td>{{ $menikah->tempat_anak }}, {{ $menikah->tgl_anak }}</td>
    </tr>
    <tr>
        <td></td>
        <td>5. Kewarganegaraan</td>
        <td>:</td>
        <td>{{ $menikah->negara_anak }}</td>
    </tr>
    <tr>
        <td></td>
        <td>6. Agama</td>
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
        <td></td>
        <td>7. Pekerjaan</td>
        <td>:</td>
        <td>{{ $menikah->pekerjaan_anak }}</td>
    </tr>
    <tr>
        <td></td>
        <td>8. Alamat</td>
        <td style="vertical-align: top">:</td>
        <td style="vertical-align: top">{{ $menikah->alamat_anak }}</td>
    </tr>

</table>

<div class="judul">Memberikan Izin kepadanya untuk melakukan perkawinan dengan seorang :</div>
<table class="data">
       
    <tr>
        <td style="width:5%";></td>
        <td style="width:40%";>1. Nama lengkap dan alias</td>
        <td>:</td>
        <td><b>{{ $menikah->nama_dgn }}</b></td>
    </tr>
    <tr>
        <td></td>
        <td>2. Bin</td>
        <td>:</td>
        <td>{{ $menikah->bin_dgn }}</td>
    </tr>
    <tr>
        <td></td>
        <td>3. Nomor Induk Kependudukan (NIK)</td>
        <td>:</td>
        <td>{{ $menikah->nik_dgn }}</td>
    </tr>
    <tr>
        <td></td>
        <td>4. Tempat dan tanggal Lahir</td>
        <td>:</td>
        <td>{{ $menikah->tempat_dgn }}, {{ $menikah->tgl_dgn }}</td>
    </tr>
    <tr>
        <td></td>
        <td>5. Kewarganegaraan</td>
        <td>:</td>
        <td>{{ $menikah->negara_dgn }}</td>
    </tr>
    <tr>
        <td></td>
        <td>6. Agama</td>
        <td>:</td>
        <td>
            @if ($menikah->agama_dgn == 1)
            <span>Islam</label>
                @elseif($menikah->agama_dgn == 2)
                <span>Kristen</label>
                    @elseif($menikah->agama_dgn == 3)
                    <span>Hindu</label>
                        @elseif($menikah->agama_dgn == 4)
                        <span>Buddha</label>
                            @elseif($menikah->agama_dgn == 5)
                            <span>Konghucu</label>
                        
              @endif
        </td>
    </tr>
    <tr>
        <td></td>
        <td>7. Pekerjaan</td>
        <td>:</td>
        <td>{{ $menikah->pekerjaan_dgn }}</td>
    </tr>
    <tr>
        <td></td>
        <td>8. Alamat</td>
        <td style="vertical-align: top">:</td>
        <td style="vertical-align: top">{{ $menikah->alamat_dgn }}</td>
    </tr>

</table>
<div class="judul">
Demikianlah surat izin ini dibuat dengan penuh kesadaran tanpa ada paksaan dari pihak manapun dan untuk dipergunakan seperlunya.</div>

<table style="width:80%"; class="ttd">
    <tr>
        <td> <b> Ayah </b></td>
        <td><b>Ibu</b></td>
    </tr>
</table>

 <br><br><br>

<table style="width:80%"; class="ttd1">
    <tr>
        <td> <b><u> {{  $menikah->nama_ayah  }} </u></b></td>
        <td><b><u>{{  $menikah->nama_ibu  }} </u></b></td>
    </tr>
</table>


<script>
    window.addEventListener("load", window.print());
  </script>
<style>
    .header{
       margin-left: 6%; 
       margin-right: 4%;
       font-weight: bold;
    }
    .data{
        margin-left: 6%; 
       margin-right: 4%;
       
    }
    .judul{
        margin-left: 6%; 
        margin-right: 4%;
        margin-bottom: 2%;
        margin-top: 2%;
    }
    .ttd{
       margin-left: 20%;
       padding-bottom: 6%;
    }
    .ttd1{
        margin-left: 15%;
       
     }
   
</style>