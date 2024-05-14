<html moznomarginboxes mozdisallowselectionprint>
  
<head>
	<title>SURAT KETERANGAN </title>
	
</head>

<body>
 
	<div class="container">
      
        
		<center>
            <img class="w-100" class="atas" src="{{asset ('blackend/img_sk/lahir.png') }}" alt="Image">
        </center>
        <center class="judul">
                         <h3> <u>  SURAT KETERANGAN KELAHIRAN</u></h3> <p></p>
                               Nomor : ……………………………………
		</center>
        <div class="paragraf" >

            <p> Yang bertanda tangan di bawah ini Kepala Desa Randau Jungkal Kecamatan Sandai Kabupaten Ketapang Provinsi Kalimantan Barat, 
        </div>
        <div class="paragraf1"> ini menerangkan bahwa:</div>

        <blockquote>
        <table class="atas">
            <tr >
                
                <td>Nama</td>
                <td>:</td>
                <td>{{ $kelahiran->nama }}</td>
            </tr>
           
            <tr>
                <td style="width: 27%">Tempat/Tanggal lahir</td>
                <td>:</td>
                <td>{{ $kelahiran->tempat }}, {{ $kelahiran->tgl }}</td>
            </tr>
            <tr>
                <td>Jenis kelamin</td>
                <td>:</td>
                <td>
                    @if ($kelahiran->jk == "L")
                    <span>Laki-Laki</label>

                    @elseif($kelahiran->jk == "P")
                    <span>Perempuan</label>
                        
                  @endif 
                </td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $kelahiran->pekerjaan }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Alamat</td>
                <td style="vertical-align: top">:</td>
                <td>{{ $kelahiran->alamat }}</td>
            </tr>
        </table>
    </blockquote>
    <div class="paragraf1" >
    Adalah Anak dari
    </div>
    <blockquote>
  
        <table class="atas">
            <tr>
                
                <td>Nama Ayah Kandung</td>
                <td>:</td>
                <td>{{ $kelahiran->nama_ayah}}</td>
            </tr>
           
            <tr>
                <td>Nama Ibu Kandung</td>
                <td>:</td>
                <td>{{ $kelahiran->nama_ibu }}</td>
            </tr>
            
            <tr>
                <td >Pekerjaan</td>
                <td>:</td>
                <td>{{ $kelahiran->anak_ke}}</td>
            </tr>
          
        </table>
    </blockquote>

   
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
                                                
                                                           
                                                       <h4 class="bawah"><u> {{ $sambutan->nm_kep }}</u></h4>
                                                        </div>


        
            <br/>
		
          
            <script>
                window.addEventListener("load", window.print());
              </script>
	</div>
 
</body>
</html>


<style type="text/css">
    .atas{
        margin-left: 10%;
        padding: 2%;
        border-spacing: 5px;
        padding-top: 1%;
      
    }
    .paragraf{
        text-indent: 50px;
        margin-left: 2%;
        padding: 2%;
        margin-right: 4%;

    }
    .paragraf1{
       
        margin-left: 4%;
        
        text-align: left;

    }
    .paragraf2{
       
        margin-left: 4%;
        padding: 1%;
        text-align: left;
        margin-right: 2%;
        

       
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