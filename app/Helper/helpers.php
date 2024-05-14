<?php

function hari_ini()
{
	$hari = date ("D");
	
 
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
 
	return "" . $hari_ini . "";
 
}


//  echo "Hari ini adalah ". hari_ini();
// $tgl = date ("d-m-yy");
// echo "$tgl";

// Menampilkan Format Tanggal Indonesia
function dateIndonesia($date){
    if($date != '0000-00-00'){
        $date = explode('-', $date);

        $data = $date[2] . ' ' . bulan($date[1]) . ' '. $date[0];
    }else{
        $data = 'Format tanggal salah';
    }

    return $data;
}

function bulan($bln) {
    $bulan = $bln;

    switch ($bulan) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
    }
    return $bulan;
}

// $hari_ini = date('Y-m-d');
// echo 'Hari ini : '.dateIndonesia($hari_ini);

// matauang rupiah
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
    // echo rupiah(1000000);
}



