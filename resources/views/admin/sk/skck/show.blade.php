<html moznomarginboxes mozdisallowselectionprint>
  
<head>
	<title>SURAT KETERANGAN </title>
</head>

<body>
 
	<div class="container">
      
        
		<center class="top">
            <img class="w-100" class="atas" src="{{asset ('blackend/img_sk/skck.png') }}" alt="Image">
        </center>
        <center class="judul">
                         <h3> <u>S U R A T    P E N G A N T A R</u></h3> <p></p>
                               Nomor : ……………………………………
		</center>
        <div class="paragraf" >

            <p> Yang bertanda tangan dibawah ini, Kepala Desa Randau Jungkal Kecamatan Sandai Kabupaten Ketapang. Menerangkan dengan sesunguhnya :

        </div>

        <table class="atas">
            <tr>
                
                <td style="width:40%";>Nama Lengkap</td>
                <td>:</td>
                <td>{{ $skck->nama }}</td>
            </tr>
            <tr>
                <td>Jenis kelamin</td>
                <td>:</td>
                <td>
                    @if ($skck->jk == "L")
                    <span>Laki-Laki</label>

                    @elseif($skck->jk == "P")
                    <span>Perempuan</label>
                        
                  @endif 
                </td>
            </tr>
           
            <tr>
                <td>Tempat/Tanggal lahir</td>
                <td>:</td>
                <td>{{ $skck->tempat }}, {{ $skck->tgl }}</td>
            </tr>
            <tr>
                <td>Suku / Kewarganegaraan</td>
                <td>:</td>
                <td>{{ $skck->negara }}, {{ $skck->tgl }}</td>
            </tr>
          
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>
                    @if ($skck->agama == 1)
                    <span>Islam</label>
                        @elseif($skck->agama == 2)
                        <span>Kristen</label>
                            @elseif($skck->agama == 3)
                            <span>Hindu</label>
                                @elseif($skck->agama == 4)
                                <span>Buddha</label>
                                    @elseif($skck->agama == 5)
                                    <span>Konghucu</label>
                                
                      @endif    
                </td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $skck->nik }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $skck->pekerjaan }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td>{{ $skck->status_kawin }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Alamat Sekarang</td>
                <td style="vertical-align: top">:</td>
                <td>{{ $skck->alamat }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top";>Maksud / Tujuan</td>
                <td style="vertical-align: top">:</td>
                <td>
                    Untuk membuat Surat Keterangan Berkelakuan
                    Baik dari Kepolisian
                </td>
            </tr>
        </table>
    <div class="paragraf1">
    Keterangan Lain – Lain <p>
    

<table>
    <tr>
        <td style="vertical-align: top";> - </td>
        <td>
        Menurut data dan catatan didalam register kependudukan kami, bahwa yang bersangkutan benar penduduk/warga Desa Randau Jungkal kecamatan Sandai Kabupaten Ketapang.
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top";> - </td>
        <td>
        Menerangkan bahwa yang bersangkutan berkelakuan baik, tidak sedang tersangkut perkara pidana atau gerakan terlarang dll.
        </td>
    </tr>
</table>
</div>
<div class="paragraf2">Demikian Surat Keterangan ini dibuat dan diberikan kepada yang bersangkutan untuk dapat dipergunakan sebagaimana mestinya.</div>

    
   
   


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


        
            <br/>
		
          
            <script>
                window.addEventListener("load", window.print());
              </script>
	</div>
</div>
</body>
</html>


<style type="text/css">
    .top{
        margin-left: 4%; 
        margin-right: 4%;

    }
    .atas{
        margin-left: 10%;
        border-spacing: 5px;
        margin-right: 4%;
    }
    .paragraf{
        text-indent: 30px;
        margin-left: 6%;
        padding: 1%;
        margin-right: 4%;

    }
    .paragraf1{
       
        margin-left: 9%;  
        text-align: left;
        margin-right: 4%;
    }
    .paragraf2{
        margin-left: 6%;
        text-align: left;
        text-indent: 30px;
        margin-right: 4%;
        
    }
    .left    { 
        text-align: left;
    }
    .bawah{
       
        padding-top: 40%;
    }
    .judul{
        line-height: 2%;
    }
    .center  { text-align: center;}
    .justify { text-align: justify;}
    .ttd{
        peding-right: 2%;
        text-align: left;
        margin-left:60%;
        line-height: 0.7%;
    }
 
 </style>