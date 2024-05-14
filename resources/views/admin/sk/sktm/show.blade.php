<html moznomarginboxes mozdisallowselectionprint>
  
<head>
	<title>SURAT KETERANGAN KURANG MAMPU</title>
	
</head>

<body>
 
	<div class="container">
      
                                     
		<center class="head">
            <img class="w-100" class="atas" src="{{asset ('blackend/img_sk/sktm.png') }}" alt="Image">
        </center>

        <center class="judul">
                         <h2> <u>  SURAT KETERANGAN KURANG MAMPU</u></h2> <p>
                               Nomor : ……………………………………
		</center>
        
        <div class="paragraf" >
          
             Yang  bertanda tanggan di bawah ini Kepala Desa Randau Jungkal Kecamatan Sandai Kabupaten Ketapang  dengan ini menerangkan bahwa :</div>
        <blockquote>  
        <table class="atas">
            <tr>
                <td style="width:30%";>1.	Nama Lengkap </td>
                <td>:</td>
                <td>{{ $sktm->nama }}</td>
            </tr>
            <tr>
                <td>2.	NIK </td>
                <td>:</td>
                <td>{{ $sktm->nik }}</td>
            </tr>
            <tr>
                <td>3.	Jenis Kelamin </td>
                <td>:</td>
                <td>
                    @if ($sktm->jk == "L")
                    <span>Laki-Laki</label>

                    @elseif($sktm->jk == "P")
                    <span>Perempuan</label>
                        
                  @endif 
                </td>
            </tr>
            <tr>
                <td>4.	Tempat Tgl Lahir </td>
                <td>:</td>
                <td>{{ $sktm->tempat }}, {{ $sktm->tgl }}</td>
            </tr>
            <tr>
                <td>5.	A g a m a</td>
                <td>:</td>
                <td>
                    @if ($sktm->agama == 1)
                    <span>Islam</label>
                        @elseif($sktm->agama == 2)
                        <span>Kristen</label>
                            @elseif($sktm->agama == 3)
                            <span>Hindu</label>
                                @elseif($sktm->agama == 4)
                                <span>Buddha</label>
                                    @elseif($sktm->agama == 5)
                                    <span>Konghucu</label>
                                
                      @endif   
                </td>
            </tr>
            <tr>
                <td>6.	Pekerjaan </td>
                <td>:</td>
                <td>{{ $sktm->pekerjaan }}</td>
            </tr>
            <tr>
                <td>7.	Status </td>
                <td>:</td>
                <td>{{ $sktm->status }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">8.	Alamat </td>
                <td style="vertical-align: top">:</td>
                <td>{{ $sktm->alamat }}</td>
            </tr>
        </table>
       </blockquote>  

       
       <b class="tab2"> Anak dari Pasangan :</b>
       <blockquote>
        <table class="atas">
            <tr>
                <td style="width:30%";><b>IBU :</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td >1.	Nama Lengkap </td>
                <td>:</td>
                <td>{{ $sktm->nama_ibu }}</td>
            </tr>

            <tr>
                <td>2.	Jenis Kelamin </td>
                <td>:</td>
                <td>
                    @if ($sktm->jk_ibu == "L")
                    <span>Laki-Laki</label>

                    @elseif($sktm->jk_ibu == "P")
                    <span>Perempuan</label>
                        
                  @endif 
                </td>
            </tr>
           
            <tr>
                <td>3.	A g a m a</td>
                <td>:</td>
                <td>
                    @if ($sktm->agama_ibu == 1)
                    <span>Islam</label>
                        @elseif($sktm->agama_ibu == 2)
                        <span>Kristen</label>
                            @elseif($sktm->agama_ibu == 3)
                            <span>Hindu</label>
                                @elseif($sktm->agama_ibu == 4)
                                <span>Buddha</label>
                                    @elseif($sktm->agama_ibu == 5)
                                    <span>Konghucu</label>
                                
                      @endif   
                </td>
            </tr>
            <tr>
                <td>4.	Pekerjaan </td>
                <td>:</td>
                <td>{{ $sktm->pekerjaan_ibu }}</td>
            </tr>
            <tr>
                <td>5.	Status </td>
                <td></td>
                <td>{{ $sktm->status_ibu }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">6.	Alamat </td>
                <td style="vertical-align: top">:</td>
                <td>{{ $sktm->alamat_ibu }}</td>
            </tr>
            <tr>
                <td><b>Ayah :</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td >1.	Nama Lengkap </td>
                <td>:</td>
                <td>{{ $sktm->nama_ayah }}</td>
            </tr>

            <tr>
                <td>2.	Jenis Kelamin </td>
                <td>:</td>
                <td>
                    @if ($sktm->jk_ayah == "L")
                    <span>Laki-Laki</label>

                    @elseif($sktm->jk_ayah == "P")
                    <span>Perempuan</label>
                        
                  @endif 
                </td>
            </tr>
           
            <tr>
                <td>3.	A g a m a</td>
                <td>:</td>
                <td>
                    @if ($sktm->agama_ayah == 1)
                    <span>Islam</label>
                        @elseif($sktm->agama_ayah == 2)
                        <span>Kristen</label>
                            @elseif($sktm->agama_ayah == 3)
                            <span>Hindu</label>
                                @elseif($sktm->agama_ayah == 4)
                                <span>Buddha</label>
                                    @elseif($sktm->agama_ayah == 5)
                                    <span>Konghucu</label>
                                
                      @endif   
                </td>
            </tr>
            <tr>
                <td>4.	Pekerjaan </td>
                <td>:</td>
                <td>{{ $sktm->pekerjaan_ayah }}</td>
            </tr>
            <tr>
                <td>5.	Status </td>
                <td></td>
                <td>{{ $sktm->status_ayah }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">6.	Alamat </td>
                <td style="vertical-align: top">:</td>
                <td>{{ $sktm->alamat_ayah }}</td>
            </tr>
        </table>
       </blockquote> 
      
      
           <h4> <u> Dengan ini menerangkan bahwa: </u></h4>
        a.	Yang bersangkutan tersebut di atas benar penduduk Desa Randau Jungkal Kecamatan Sandai Kabupaten Ketapang <br>
        b.	Menurut Catatan Regester Kependudukan Benar termasuk Golongan Keluarga Kurang Mampu / Miskin <br>
        c.	Surat keterangan ini di berikan kepada yang bersangkutan untuk mendapatkan ………………………….. <br>
      Demikian Surat Keterangan ini dibuat dan diberikan kepada yang bersangkutan untuk dapat dipergunakan sebagaimana mestinya.

                                                
                                                            
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


		
          
                <script>
                window.addEventListener("load", window.print());
               </script>
</div>
 
</body>
</html>


<style type="text/css">
    .head{
        margin-left: 1%;
        margin-right: 2%;

    }
    .atas{
      
        border-spacing: 5px;
        line-height: 0.9; 
        margin-bottom: 1%;
        margin-right: 2%;
        padding-top: 0%;

    }
    .paragraf{
        text-indent: 50px;
        margin-left: 4%;
        margin-right: 2%;

    }
    .paragraf1{
       
        margin-left: 2%;
        text-align: left;

    }
    .paragraf2{
       
        margin-left: 14%;
        padding: 1%;
        text-align: left;
        text-indent: 30px;
        margin-right: 5%;
    }
    .left    { 
        text-align: left;
    }
    .bawah{
       
        padding-top: 20%;
    }
    .judul{
        line-height: 0.4;
        margin-bottom: 3%
    }
    .center  { text-align: center;}
    .justify { text-align: justify;}
    .ttd{
        padding-right: 2%;
        text-align: left;
        margin-left:60%;
        line-height: 0.7%;
    }
    .tab2{
        margin-left:4%;
        padding-bottom: 0%;
        line-height: 0; 

        
    }
 
 </style>