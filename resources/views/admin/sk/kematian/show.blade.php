<html moznomarginboxes mozdisallowselectionprint>
  
<head>
	<title>SURAT KETERANGAN </title>
</head>

<body>
 
	<div class="container">
      
        
		<center>
            <img class="w-100" class="atas" src="{{asset ('blackend/img_sk/kematian.png') }}" alt="Image">
        </center>
        <center class="judul">
                         <h3> <u>  SURAT KETERANGAN KEMATIAN</u></h3> <p></p>
                               Nomor : ……………………………………
		</center>
        <div class="paragraf" >

            <p> Yang bertanda tangan di bawah ini Kepala Desa Randau Jungkal Kecamatan Sandai Kabupaten Ketapang Provinsi Kalimantan Barat, menerangkan dengan sesungguhnya bahwa :</div>
<blockquote>
        <table class="atas">
            <tr >
                
                <td style="width:40%";>1. Nama Lengkap</td>
                <td>:</td>
                <td>{{ $skmatian->nama }}</td>
            </tr>
           
            <tr>
                <td>2. Tempat/Tanggal lahir</td>
                <td>:</td>
                <td>{{ $skmatian->tempat }}, {{ $skmatian->tgl }}</td>
            </tr>
            <tr>
                <td>3. Jenis kelamin</td>
                <td>:</td>
                <td>
                    @if ($skmatian->jk == "L")
                    <span>Laki-Laki</label>

                    @elseif($skmatian->jk == "P")
                    <span>Perempuan</label>
                        
                  @endif 
                </td>
            </tr>
          
            <tr>
                <td>4. Agama</td>
                <td>:</td>
                <td>
                    @if ($skmatian->agama == 1)
                    <span>Islam</label>
                        @elseif($skmatian->agama == 2)
                        <span>Kristen</label>
                            @elseif($skmatian->agama == 3)
                            <span>Hindu</label>
                                @elseif($skmatian->agama == 4)
                                <span>Buddha</label>
                                    @elseif($skmatian->agama == 5)
                                    <span>Konghucu</label>
                                
                      @endif    
                </td>
            </tr>
          
            <tr>
                <td style="vertical-align: top">5. Alamat</td>
                <td style="vertical-align: top">:</td>
                <td>{{ $skmatian->alamat }}</td>
            </tr>
        </table>
    </blockquote>


    @php
    $tanggal = $skmatian->waktu;
    $Pecah = explode( ",", $tanggal );
    //Menampilkan otomatis menggunakan for
    for ( $i = 0; $i < count( $Pecah ); $i++ ) {  
    }
    @endphp
<blockquote>
    <table class="atas">
        <tr>
            <td style="vertical-align: top">a. </td>
            <td>
    	 benar Penduduk asli Dusun Randau Jungkal Desa Randau Jungkal, Kecamatan Sandai Kabupaten Ketapang Provinsi Kalimantan Barat

            </td>
        </tr>
        <tr>
            <td style="vertical-align: top">b. </td>
            <td>
            Adapun Namanya yang tercantum diatas benar telah Meninggal Dunia pada Hari
            {{ $Pecah[0] }} Tanggal {{ dateIndonesia($Pecah[1]) }} dikarnakan Sakit {{ $skmatian->kronologi }}
            </td>
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
        margin-left: 8%;
        border-spacing: 5px;
        padding-top: 1%;
        margin-right: 2%;


    }
    .paragraf{
        text-indent: 50px;
        margin-left: 6%;
        padding: 2%;
        margin-right: 2%;
        
    }
    .paragraf1{
       
        margin-left: 8%;
        text-align: left;

    }
    .paragraf2{
       
        margin-left: 12%;
        padding: 1%;
        text-align: left;
        text-indent: 30px;
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