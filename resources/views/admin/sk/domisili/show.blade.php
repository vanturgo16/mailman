<html moznomarginboxes mozdisallowselectionprint>
  
<head>
	<title>SURAT KETERANGAN BERDOMISILI</title>
</head>

<body>
 
	<div class="container">
      
        
		<center>
            <img class="w-100" class="atas" src="{{asset ('blackend/img_sk/domisili.png') }}" alt="Image">
        </center>
        <center class="judul">
                         <h3> <u>  SURAT KETERANGAN BERDOMISILI</u></h3> <p></p>
                              <h4>  Nomor : ……………………………………</h4>

		</center>
        <div class="atas">

            Yang  bertanda tangan dibawah ini, Kepala Desa Randa Jungkal Kecamatan Sandai kabupaten  Ketapang, menerangkan dengan sesungguhnya bahwa :</div>

        <table class="atas">
            <tr >
                <td style="width:25%";>Nama Lengkap</td>
                <td>:</td>
                <td>{{ $domisili->nama }}</td>
            </tr>
            <tr>
                <td>Jenis kelamin</td>
                <td>:</td>
                <td>
                    @if ($domisili->jk == "L")
                        <span>Laki-Laki</label>

                        @elseif($domisili->jk == "P")
                        <span>Perempuan</label>
                            
                      @endif 
                </td>
            </tr>
            <tr>
                <td>Tempat/Tanggal lahir</td>
                <td>:</td>
                <td>{{ $domisili->tempat }}, {{ $domisili->tgl }}</td>
            </tr>
            <tr>
                <td>Warga Negara</td>
                <td>:</td>
                <td>{{ $domisili->negara }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>
                    @if ($domisili->agama == 1)
                    <span>Islam</label>
                        @elseif($domisili->agama == 2)
                        <span>Kristen</label>
                            @elseif($domisili->agama == 3)
                            <span>Hindu</label>
                                @elseif($domisili->agama == 4)
                                <span>Buddha</label>
                                    @elseif($domisili->agama == 5)
                                    <span>Konghucu</label>
                                
                      @endif    
                    </td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $domisili->pekerjaan }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Alamat Sekarang</td>
                <td style="vertical-align: top">:</td>
                <td>{{ $domisili->alamat }}</td>
            </tr>
        </table>
  <div class="atas">
        Yang    bersangkutan   diatas   benar   penduduk   Desa   Randau   Jungkal   dan   sudah   terdaftar  sebagai kependudukan Desa Randau Jungkal Kecamatan Sandai Kabupaten Ketapang.
<p>Demikian   Surat   Keterangan   ini  Kami   buat   dan  diberikan  kepada  yang   bersangkutan   untuk dapat dipergunakan sebagaimana mestinya.
  </div>
 <br>
 <div class="ttd">                                                       
                                                            
                                                        @php
                                                        $tgl = date ('Y-m-d');
                                                        @endphp
                                                        
                                                        Dikeluarkan  Di	: Randau Jungkal<p>
                                                        Pada Tanggal	: {{hari_ini()}},
                                                        {{ dateIndonesia($tgl) }}<p>
                                                        Kepala Desa Randau Jungkal<p>

                                                       <h4 class="bawah"><u>{{ $sambutan->nm_kep }}</u></h4>
                                                        </div>

            <script>
                window.addEventListener("load", window.print());
              </script>
	</div>
  
</body>
</html>
<style type="text/css">
    .atas{
        margin-left: 2%;
        padding: 2%;

    }
    .left    { 
        text-align: left;
    }
    .judul{
        line-height: 1%;

    }
 
    .center  { text-align: center;}
    .justify { text-align: justify;}
    .ttd{
        peding-right: 2%;
        text-align: left;
        margin-left:60%;
        line-height: 0.7%;
    }
    .bawah{
       
        padding-top: 40%;
    }
 
 </style>
