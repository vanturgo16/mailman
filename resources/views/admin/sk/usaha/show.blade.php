<html moznomarginboxes mozdisallowselectionprint>
  
<head>
	<title>SURAT KETERANGAN </title>
	
</head>
    @php
    $tgl = date ('Y-m-d');
    @endphp
<body>
 
	<div class="container">
      
        
		<center>
            <img class="w-100" class="atas" src="{{asset ('blackend/img_sk/usaha.png') }}" alt="Image">
        </center>
        <center class="judul">
                         <h3> <u>  SURAT KETERANGAN USAHA</u></h3> <p></p>
                               Nomor : ……………………………………
		</center>
        <div class="paragraf" >

            <p> Yang  bertanda tanggan di bawah ini Kepala Desa Randau Jungkal Kecamatan Sandai Kabupaten Ketapang dengan ini menerangkan : 
        </div>
       

       
        <table class="atas">
            <tr>
                
                <td>1. Nama</td>
                <td>:</td>
                <td>{{ $usaha->nama }}</td>
            </tr>
            <tr>
                
                <td>2. NIK</td>
                <td>:</td>
                <td>{{ $usaha->nik }}</td>
            </tr>
            <tr>
                <td>3. Jenis kelamin</td>
                <td>:</td>
                <td>
                    @if ($usaha->jk == "L")
                    <span>Laki-Laki</label>

                    @elseif($usaha->jk == "P")
                    <span>Perempuan</label>
                        
                  @endif 
                </td>
            </tr>
            <tr>
                <td style="width: 27%">4. Tempat/Tanggal lahir</td>
                <td>:</td>
                <td>{{ $usaha->tempat }}, {{ $usaha->tgl }}</td>
            </tr>
           
            <tr>
                <td>5. Pekerjaan</td>
                <td>:</td>
                <td>{{ $usaha->pekerjaan }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">6. Alamat</td>
                <td style="vertical-align: top">:</td>
                <td>{{ $usaha->alamat }}</td>
            </tr>
        </table>
   
    <div class="paragraf1" >
        Keterangan Lain-lain	:<br>
        Benar bahwa Namanya yang tersebut diatas adalah penduduk yang berdomisili di Desa Randau Jungkal, Kecamatan Sandai, Kabupaten Ketapang, dan saat ini mempunyai usaha :
        
    </div>
    <blockquote>
  
        <table class="atas">
            <tr>
                
                <td style="width: 27%">Jenis Usaha</td>
                <td>:</td>
                <td>{{ $usaha->jns_usaha}}</td>
            </tr>
           
            <tr>
                <td>Merk Usaha</td>
                <td>:</td>
                <td>{{ $usaha->merek_usaha }}</td>
            </tr>
            <tr>
                <td>Karyawan</td>
                <td>:</td>
                <td>{{ $usaha->kry }}</td>
            </tr>
            
            <tr>
                <td >Modal Usaha</td>
                <td>:</td>
                <td>
                     {{ rupiah ($usaha->modal) }}
                    
              
                </td>
            </tr>
            <tr>
                <td >Luas Bangunan </td>
                <td>:</td>
                <td>{{ $usaha->luas_bangunan}}</td>
            </tr>
            <tr>
                <td >Bangunan Toko</td>
                <td>:</td>
                <td>{{ $usaha->bangunan_toko}}</td>
            </tr>
            <tr>
                <td >No HP</td>
                <td>:</td>
                <td>{{ $usaha->no_hp}}</td>
            </tr>
            <tr>
                <td >Pendidikan</td>
                <td>:</td>
                <td>
                    @if ($usaha->pendidikan == 1)
                    <span>SD/MI</label>
                        @elseif($usaha->pendidikan == 2)
                        <span>SMP/MTS</label>
                            @elseif($usaha->pendidikan == 3)
                            <span>SMA/SMK/MA</label>
                                @elseif($usaha->pendidikan == 4)
                                <span>Diploma</label>
                                    @elseif($usaha->pendidikan == 5)
                                    <span>Sterata 1 (S1)</label>
                                        @elseif($usaha->pendidikan == 6)
                                        <span>Sterata 2 (S2)</label>
                                            @elseif($usaha->pendidikan == 7)
                                            <span>Sterata 3 (S3)</label>
                                                @elseif($usaha->pendidikan == 8)
                                                <span>Lainnya</label>
                                
                      @endif    
                   
            </tr>
            <tr>
                <td style="vertical-align: top" >Alamat Usaha</td>
                <td style="vertical-align: top">:</td>
                <td>{{ $usaha->alamat_usaha}}</td>
            </tr>
          
        </table>
    </blockquote>

   
<div class="paragraf1">
    Surat Keterangan ini diberikan kepada yang bersangkutan guna untuk persyaratan kelengkapan administrasi.
    Demikian surat keterangan ini dibuat dan diberikan kepada yang bersangkutan untuk dapat dipergunakan sebagaimana mestinya.
 <br>
 <p>
                                                        
                                                            
<div class="ttd">
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
 
</body>
</html>


<style type="text/css">
    .atas{
        margin-left: 8%;
        padding: 2%;
        border-spacing: 5px;
        padding-top: 1%;
        margin-right: 4%;

      
    }
    .paragraf{
        text-indent: 50px;
        margin-left: 2%;
        padding: 2%;
        margin-right: 4%;

    }
    .paragraf1{
       
        margin-left: 4%;
        margin-right: 4%;
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