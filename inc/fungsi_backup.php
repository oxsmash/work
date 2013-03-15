<?php
/*
1 = member biasa
2 = alumni
3 = admin cabang
4 = admin pusat
*/

function removeEvilAttributes($tagSource)
{
	$stripAttrib = "' (style|class)=\"(.*?)\"'i";
	$tagSource = stripslashes($tagSource);
	$tagSource = preg_replace($stripAttrib, '', $tagSource);
	return $tagSource;
}

function removeEvilTags($source)
{
	$allowedTags='<a><br><b><h1><h2><h3><h4><i>' .
	'<img><li><ol><p><strong><table>' .
	'<tr><td><th><u><ul>';
	$source = strip_tags($source, $allowedTags);
	return preg_replace('/<(.*?)>/ie', "'<'.removeEvilAttributes('\\1').'>'", $source);
}

function gantiArray($namaArray,$nilai)
{
	if(!in_array($nilai,$namaArray))
	{
		if(count($namaArray) == 10 ) array_shift($namaArray);
		array_push($namaArray,$nilai);
	}
	return $namaArray;
}

function hapusArray($nArray,$no)
{
	//menghapus awal array array_shift($nama_array);
	//menghapus akhir array array_pop($nama_array);
	$hapusArray_zzz=$nArray;
	$hapusArray=$nArray;
	if($no < count($nArray))
	{
		if($no==0)
		{
			$hapusArray=array_shift($nArray);
			$hapusArray=$nArray;
		}
		if($no==(count($hapusArray_zzz)-1))
		{
			$hapusArray=array_pop($nArray);
			$hapusArray=$nArray;
		}
		if($no > 0 and $no < (count($hapusArray_zzz)-1))
		{
			$temp_hapusArray = array_splice($nArray,$no);
			$temp_hapusArray2 = array_splice($nArray,0,$no);
			$temp_hapusArray3 = array_shift($temp_hapusArray);
			$hapusArray=array_merge($temp_hapusArray2,$temp_hapusArray);
		}
	}
	return $hapusArray;
}

$AdminEmail = "";
$now = date("Y-m-d H:i:s");


/*
"seconds" - seconds
"minutes" - minutes
"hours" - hours
"mday" - day of the month
"wday" - day of the week as a number
"mon" - month as a number
"year" - year
"yday" - day of the year as a number
"month" - full month name
*/
$selisihJam = 0;
$tanggal_array=getdate(time());

if($tanggal_array["mon"] > 10 or $tanggal_array["mon"] < 4)
{
	$selisihJam = 0;
}
if($tanggal_array["mon"] > 3 and $tanggal_array["mon"] < 11)
{
	if($tanggal_array["mon"]=4 and $tanggal_array["mday"]< 7) $selisihJam = 12;
	if(!($tanggal_array["mon"]=4 and $tanggal_array["mday"]< 7)) $selisihJam = 11;
	if($tanggal_array["mon"]=10 and $tanggal_array["mday"]>24) $selisihJam = 12;
}

Function selisihJam()
{
	$tanggal_array=getdate(time());
	if($tanggal_array["mon"]>10 or $tanggal_array["mon"]< 4) $selisihJam = 12;

	if($tanggal_array["mday"]> 3 and $tanggal_array["mon"]< 11)
	{
		if($tanggal_array["mon"]=4 and $tanggal_array["mday"]< 7) $selisihJam = 12;
		if(!($tanggal_array["mon"]=4 and $tanggal_array["mday"]< 7)) $selisihJam = 11;
		if($tanggal_array["mon"]=10 and $tanggal_array["mday"]>24) $selisihJam = 12;
	}
	$globalWaktuIndonesia="yes";
	if($globalWaktuIndonesia=="yes") $selisihJam=0;
	return $selisihJam;
}

Function waktuIndonesia()
{
	$SERVER_TIMEZONE = date("Z"); // zona waktu di server
	$WANTED_TIMEZONE = 7*3600;    // zona waktu yg ingin ditampilkan, GMT+7
	// timestamp yang ingin dikonversi
	$timestamp = time();
	$waktuIndonesia=$timestamp - $SERVER_TIMEZONE + $WANTED_TIMEZONE;
	return $waktuIndonesia;
}

Function waktuIndonesia2()
{
	$SERVER_TIMEZONE = date("Z"); // zona waktu di server
	$WANTED_TIMEZONE = 7*3600;    // zona waktu yg ingin ditampilkan, GMT+7
	// timestamp yang ingin dikonversi
	$timestamp = time();
	$waktuIndonesia=$timestamp - $SERVER_TIMEZONE + $WANTED_TIMEZONE;
	$waktuIndonesia2=date("Y-m-d H:i:s",$timestamp - $SERVER_TIMEZONE + $WANTED_TIMEZONE);
	return $waktuIndonesia2;
}

Function cekEmail($fn)
{
	$isEmail=1;
	if(strpos($fn,".") < 0) $isEmail=0;
	if(strpos($fn,"@") < 3) $isEmail=0;
	if(strpos($fn,".") - strpos($fn,"@")==1) $isEmail=0;
	if(strpos($fn,".",strpos($fn,"@")) - strpos($fn,"@") < 1) $isEmail=0;
	if(strlen($fn)<6) $isEmail=0;
	return $isEmail;
}

Function putusKalimat($xkata,$lebar)
{
	$kalimat = str_replace("<br>"," ",$xkata);
	$panjang = substr($kalimat,0,$lebar);
	if(strlen($kalimat) > $lebar)
	{
		$cari_spasi = strpos($kalimat," ",$lebar);
		$kalimatBaru = substr($kalimat,0,$cari_spasi);
		if($cari_spasi=="") $kalimatBaru = $kalimat;
	}
	if(strlen($kalimat) < $lebar) $kalimatBaru=$kalimat;
	return $kalimatBaru;
}
Function dataMasuk($aaa)
{
	$aaa = str_replace(chr(34),"&quot;",$aaa);
	$aaa = str_replace("'","&#39;",$aaa);
	$aaa = trim(str_replace("<","&lt;",$aaa));
	return $aaa;
}
function dataKeluar($ps2)
{
	$ps2=trim(str_replace("&lt;","<",$ps2));
	$ps2=str_replace("&gt;",">",$ps2);
	$ps2=str_replace(chr(34),"&quot;",$ps2);
	$ps2=str_replace("'","&#39;",$ps2);
	$ps2=str_replace(vbcrlf,"<br>",$ps2);
	return $ps2;
}

function rubahKeUnix($access_date)
{
	$date_elements =  explode("-" ,$access_date);

	// at this point
	// $date_elements[0] = 2000
	// $date_elements[1] = 5
	// $date_elements[2] = 27
	$jam_elements =  explode(":" ,$access_date);

	// $jam_elements[0] = 10 jam
	// $jam_elements[1] = 15 menit
	// $jam_elements[2] = 27 detik

	if(strlen($jam_elements[1]) > 0)
	{
		$jam_elements[0]=substr($jam_elements[0],strlen($jam_elements[0]) - 2);
		$rubahKeUnix=mktime ($jam_elements[0], $jam_elements[1], $jam_elements[2], $date_elements [1], $date_elements[ 2],$date_elements [0]);
	}
	else
	{
		if($date_elements [0] < 1970) $date_elements [0]=1970;
		$rubahKeUnix=mktime (0, 0,0 ,$date_elements [1], $date_elements[2],$date_elements [0]);
	}
	return $rubahKeUnix;
}

function cekTanggal($access_date)
{
	$date_elements =  explode("-" ,$access_date);

	// at this point
	// $date_elements[0] = 2000
	// $date_elements[1] = 5
	// $date_elements[2] = 27

	$cekTanggal=checkdate($date_elements [1], $date_elements[ 2],$date_elements [0]);
	return $cekTanggal;
}


function cekTelpon($access_telp)
{
	$date_elements =  explode("," ,$access_telp);
	$cekTelpon=0;
	for($j=0;$j < count($date_elements);$j++)
	{
		if(!is_numeric($date_elements [$j])) $cekTelpon=$cekTelpon+1;
	}
	return $cekTelpon;
}

function tampilTelpon($access_telp)
{
	$access_telp_tampil =  explode(",",$access_telp);
	for($j=0;$j < count($access_telp_tampil);$j++)
	{
		if(strlen($access_telp_tampil[$j]) < 6) $tmpTelpon[$j]=$access_telp_tampil[$j];
		if(strlen($access_telp_tampil[$j])==6) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,3)."-".substr($access_telp_tampil[$j],3);
		if(strlen($access_telp_tampil[$j])==7) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,4)."-".substr($access_telp_tampil[$j],4);
		if(strlen($access_telp_tampil[$j])==8) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,4)."-".substr($access_telp_tampil[$j],4);
		if(strlen($access_telp_tampil[$j])==9) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,3)."-".substr($access_telp_tampil[$j],3,3)."-".substr($access_telp_tampil[$j],6);
		if(strlen($access_telp_tampil[$j])==10) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,4)."-".substr($access_telp_tampil[$j],4,3)."-".substr($access_telp_tampil[$j],7);
		if(strlen($access_telp_tampil[$j])==11) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,4)."-".substr($access_telp_tampil[$j],4,4)."-".substr($access_telp_tampil[$j],8);
		if(strlen($access_telp_tampil[$j])==12) $tmpTelpon[$j]=substr($access_telp_tampil[$j],0,4)."-".substr($access_telp_tampil[$j],4,4)."-".substr($access_telp_tampil[$j],9);
		$tampilTelpon=$tampilTelpon.$tmpTelpon[$j].",";
	}
	$tampilTelpon=substr($tampilTelpon,0,strlen($tampilTelpon) - 1);
	return $tampilTelpon;
}
/*
untuk interval

yyyy     year
q	Quarter
m	Month
y	Day of year
d	Day
w	Weekday
ww       Week of year
h	Hour
n	Minute
s	Second

*/
Function DateAdd ($interval,  $number, $date)
{

	$date_time_array  = getdate($date);

	$hours =  $date_time_array["hours"];
	$minutes =  $date_time_array["minutes"];
	$seconds =  $date_time_array["seconds"];
	$month =  $date_time_array["mon"];
	$day =  $date_time_array["mday"];
	$year =  $date_time_array["year"];

	switch ($interval) {

		case "yyyy":
		$year +=$number;
		break;
		case "q":
		$year +=($number*3);
		break;
		case "m":
		$month +=$number;
		break;
		case "y":
		case "d":
		case "w":
		$day+=$number;
		break;
		case "ww":
		$day+=($number*7);
		break;
		case "h":
		$hours+=$number;
		break;
		case "n":
		$minutes+=$number;
		break;
		case "s":
		$seconds+=$number;
		break;

	}
	$timestamp =  mktime($hours ,$minutes, $seconds,$month ,$day, $year);
	//$timestamp =  $hours."-".$minutes."-".$seconds."-".$month."-".$day."-".$year;
	return $timestamp;
}

Function DateAdd2($interval2,  $number2, $dateNya)
{

	$vTanggal=$dateNya;

	$hours2 =  substr($vTanggal,11,2);
	$minutes2 =  substr($vTanggal,14,2);
	$seconds2 =  substr($vTanggal,17,2);
	$month2 =  substr($vTanggal,5,2);
	$day2 =  substr($vTanggal,8,2);
	$year2 =  substr($vTanggal,0,4);


	switch ($interval2) {

		case "yyyy":
		$year2 +=$number2;
		break;
		case "q":
		$year2 +=($number2*3);
		break;
		case "m":
		$month2 +=$number2;
		break;
		case "y":
		case "d":
		case "w":
		$day2+=$number2;
		break;
		case "ww":
		$day2+=($number2*7);
		break;
		case "h":
		$hours2+=$number2;
		break;
		case "n":
		$minutes2+=$number2;
		break;
		case "s":
		$seconds2+=$number2;
		break;

	}
	$timestamp2 =  mktime($hours2 ,$minutes2, $seconds2,$month2 ,$day2, $year2);
	//$timestamp =  $hours."-".$minutes."-".$seconds."-".$month."-".$day."-".$year;
	return $timestamp2;
}

Function DateDiff ($interval, $date1,$date2)
{

	// get the number of seconds between the two dates
	$timedifference =  $date2 - $date1;

	switch ($interval) {
		case "w":
		$retval  = bcdiv($timedifference ,604800);
		break;
		case "d":
		$retval  = bcdiv( $timedifference,86400);
		break;
		case "h":
		$retval = bcdiv ($timedifference,3600);
		break;
		case "n":
		$retval  = bcdiv( $timedifference,60);
		break;
		case "s":
		$retval  = $timedifference;
		break;

	}
	return $retval;

}

Function xBulanIndo($xBulanIndo)
{
	if($xBulanIndo == 1) $xBulanIndo="Januari";
	if($xBulanIndo == 2) $xBulanIndo="Februari";
	if($xBulanIndo == 3) $xBulanIndo="Maret";
	if($xBulanIndo == 4) $xBulanIndo="April";
	if($xBulanIndo == 5) $xBulanIndo="Mei";
	if($xBulanIndo == 6) $xBulanIndo="Juni";
	if($xBulanIndo == 7) $xBulanIndo="Juli";
	if($xBulanIndo == 8) $xBulanIndo="Agustus";
	if($xBulanIndo == 9) $xBulanIndo="September";
	if($xBulanIndo == 10) $xBulanIndo="Oktober";
	if($xBulanIndo == 11) $xBulanIndo="November";
	if($xBulanIndo == 12) $xBulanIndo="Desember";
	return $xBulanIndo;
}

Function xBulanIndo2($xBulanIndo)
{
	if($xBulanIndo == 1) $xBulanIndo="January";
	if($xBulanIndo == 2) $xBulanIndo="February";
	if($xBulanIndo == 3) $xBulanIndo="March";
	if($xBulanIndo == 4) $xBulanIndo="April";
	if($xBulanIndo == 5) $xBulanIndo="May";
	if($xBulanIndo == 6) $xBulanIndo="June";
	if($xBulanIndo == 7) $xBulanIndo="July";
	if($xBulanIndo == 8) $xBulanIndo="August";
	if($xBulanIndo == 9) $xBulanIndo="September";
	if($xBulanIndo == 10) $xBulanIndo="October";
	if($xBulanIndo == 11) $xBulanIndo="November";
	if($xBulanIndo == 12) $xBulanIndo="December";
	return $xBulanIndo;
}

Function xHariIndo($xHariIndo)
{
	if($xHariIndo == 0) $xHariIndo="Minggu";
	if($xHariIndo == 1) $xHariIndo="Senin";
	if($xHariIndo == 2) $xHariIndo="Selasa";
	if($xHariIndo == 3) $xHariIndo="Rabu";
	if($xHariIndo == 4) $xHariIndo="Kamis";
	if($xHariIndo == 5) $xHariIndo="Jum'at";
	if($xHariIndo == 6) $xHariIndo="Sabtu";
	return $xHariIndo;
}

Function xHariIndo2($xHariIndo2)
{
	if($xHariIndo2 == 0) $xHariIndo2="Sunday";
	if($xHariIndo2 == 1) $xHariIndo2="Monday";
	if($xHariIndo2 == 2) $xHariIndo2="Tuesday";
	if($xHariIndo2 == 3) $xHariIndo2="Wednesday";
	if($xHariIndo2 == 4) $xHariIndo2="Thursday";
	if($xHariIndo2 == 5) $xHariIndo2="Friday";
	if($xHariIndo2 == 6) $xHariIndo2="Saturday";
	return $xHariIndo2;
}

Function utk2Digit($xWaktu)
{
	$xWaktu=intval($xWaktu);
	if($xWaktu < 10) $utk2Digit = "0".$xWaktu ;
	else $utk2Digit = $xWaktu;
	return $utk2Digit;
}

Function utk4Digit($xEmpat)
{
	$xEmpatR=$xEmpat;
	if(strlen($xEmpat) == 1) $xEmpatR="000".$xEmpat;
	if(strlen($xEmpat) == 2) $xEmpatR="00".$xEmpat;
	if(strlen($xEmpat) == 3) $xEmpatR="0".$xEmpat;
	return $xEmpatR;
}

Function utk5Digit($xLima)
{
	$xLimaR=$xLima;
	if(strlen($xLima) == 1) $xLimaR="0000".$xLima;
	if(strlen($xLima) == 2) $xLimaR="000".$xLima;
	if(strlen($xLima) == 3) $xLimaR="00".$xLima;
	if(strlen($xLima) == 4) $xLimaR="0".$xLima;
	return $xLimaR;
}

Function voucher10Digit($xSepuluh)
{
	if(strlen($xSepuluh) == 1) $xSepuluh="000000000".$xSepuluh;
	if(strlen($xSepuluh) == 2) $xSepuluh="00000000".$xSepuluh;
	if(strlen($xSepuluh) == 3) $xSepuluh="0000000".$xSepuluh;
	if(strlen($xSepuluh) == 4) $xSepuluh="000000".$xSepuluh;
	if(strlen($xSepuluh) == 5) $xSepuluh="00000".$xSepuluh;
	if(strlen($xSepuluh) == 6) $xSepuluh="0000".$xSepuluh;
	if(strlen($xSepuluh) == 7) $xSepuluh="000".$xSepuluh;
	if(strlen($xSepuluh) == 8) $xSepuluh="00".$xSepuluh;
	if(strlen($xSepuluh) == 9) $xSepuluh="0".$xSepuluh;
	return $xSepuluh;
}

Function HariIni($date)
{
	$date_time_array  = getdate(DateAdd("h",selisihJam(),$date));
	$weekday =  xHariIndo($date_time_array["wday"]);
	$month =  xBulanIndo($date_time_array["mon"]);
	$day =  $date_time_array["mday"];
	$year =  $date_time_array["year"];
	$xHariIni=$weekday.", ".$day." ".$month." ".$year;
	return $xHariIni;
}

Function tahunBulan($date)
{

	$date_time_array  = getdate($date);
	$month =  $date_time_array["mon"];
	if(strlen($month) < 2) $month="0".$month;
	$year =  substr($date_time_array["year"],2);
	$tahunBulan=$year.$month;
	return $tahunBulan;
}

Function tahunNya($date)
{

	$date_time_array  = getdate($date);
	$year =  $date_time_array["year"];
	$tahunNya=$year;
	return $tahunNya;
}

Function bulanNya($date)
{

	$date_time_array  = getdate($date);
	$month =  $date_time_array["month"];
	if($month=1) $month="I";
	if($month=1) $month="II";
	if($month=1) $month="III";
	if($month=1) $month="IV";
	if($month=1) $month="V";
	if($month=1) $month="VI";
	if($month=1) $month="VII";
	if($month=1) $month="VIII";
	if($month=1) $month="IX";
	if($month=1) $month="X";
	if($month=1) $month="XI";
	if($month=1) $month="XII";
	$bulanNya=$month;
	return $bulanNya;
}

Function tglIndo()
{
	//argumen asli ($xTgl,$formatNya,$selisihJam)
	//argumen tambahan $sisaTanggal
	$objArgs = func_get_args();
	$nCount = count($objArgs);
	$xTgl=$objArgs[0];
	if(strpos($xTgl,"-") > 0) $xTgl=rubahKeUnix($xTgl);
	$formatNya=$objArgs[1];
	$selisihJam=$objArgs[2];
	$sisaTanggal=0;
	if($nCount > 3)
	{
		$sisaTanggal=$objArgs[3];
	}
	$xTgl = getdate(DateAdd("h",$selisihJam,$xTgl));
	//l = long Date (Selasa, 1 Januari 2002, 03:00 WIB)
	//h = long Date (Selasa, 1 Januari 2002, 03:00 WIB)
	//s = short Date (1 Januari 2002)
	//t = time (03:00 WIB)
	//f = (7/22/2003 9:50:37 PM)
	if($formatNya == "l")
	{
		$TglIndo = xHariIndo($xTgl["wday"]).", ".$xTgl["mday"]." ".xBulanIndo($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal).", ".utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"])." WIB";
	}
	elseif($formatNya == "l_e")
	{
		$TglIndo = $xTgl["weekday"].", ".$xTgl["month"]." ".$xTgl["mday"].", ".($xTgl["year"] - $sisaTanggal)." - ".utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"])." WIT (GMT + 7)";
	}
	elseif($formatNya == "h")
	{
		$TglIndo = xHariIndo($xTgl["wday"]).", ".$xTgl["mday"]." ".xBulanIndo($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal);
	}
	elseif($formatNya == "f")
	{
		$TglIndo =$xTgl["mday"]."/".$xTgl["mon"]."/".($xTgl["year"] - $sisaTanggal).", ".utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"])." WIB";
	}
	elseif($formatNya == "s")
	{
		$TglIndo = $xTgl["mday"]." ".xBulanIndo($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal);
	}
	elseif($formatNya == "jawa")
	{
		$TglIndo = xHariIndo($xTgl["wday"])." ".weton($objArgs[0]).", ".$xTgl["mday"]." ".xBulanIndo($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal);
	}
	elseif($formatNya == "s_e")
	{
		$TglIndo = $xTgl["mday"]." ".xBulanIndo2($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal);
	}
	elseif($formatNya == "t")
	{
		$TglIndo = utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"])." WIB";
	}
	elseif($formatNya == "z")
	{
		$TglIndo = $xTgl["mday"]." ".xBulanIndo($xTgl["mon"])." ".($xTgl["year"] - $sisaTanggal).", ".utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"]).":".utk2Digit($xTgl["seconds"])." WIB";
	}
	elseif($formatNya == "z_e")
	{
		$TglIndo = $xTgl["mday"]." ".$xTgl["month"]." ".($xTgl["year"] - $sisaTanggal)." - ".utk2Digit($xTgl["hours"]).":".utk2Digit($xTgl["minutes"]).":".utk2Digit($xTgl["seconds"])." WIT (GMT + 7)";
	}
	return $TglIndo;
}

function MakeTime()
{
	$objArgs = func_get_args();
	$nCount = count($objArgs);
	if ($nCount < 7)
	{
		$objDate = getdate();
		if ($nCount < 1)
		$objArgs[] = $objDate["hours"];
		if ($nCount < 2)
		$objArgs[] = $objDate["minutes"];
		if ($nCount < 3)
		$objArgs[] = $objDate["seconds"];
		if ($nCount < 4)
		$objArgs[] = $objDate["mon"];
		if ($nCount < 5)
		$objArgs[] = $objDate["mday"];
		if ($nCount < 6)
		$objArgs[] = $objDate["year"];
		if ($nCount < 7)
		$objArgs[] = -1;
	}
	$nYear = $objArgs[5];
	$nOffset = 0;
	if ($nYear < 1970)
	{
		if ($nYear < 1902)
		return 0;
		else if ($nYear < 1952)
		{
			$nOffset = -2650838400;
			$objArgs[5] += 84;
			// Apparently dates before 1942 were never DST
			if ($nYear < 1942)
			$objArgs[6] = 0;
		}
		else
		{
			$nOffset = -883612800;
			$objArgs[5] += 28;
		}
	}

	return call_user_func_array("mktime", $objArgs) + $nOffset;
}


Function bikinThumbnail($gaFile,$gDir,$gSize)
{

	global $accNya;
	if (!isset($img))
	{
		$img = $gaFile;
	}
	$imgdir = $gDir;

	$tndir = $gDir."tn/";

	$tn_w = $gSize;
	if (!file_exists($imgdir.$img))
	{
		echo $imgdir.$img;
		die ("Error: File not found...");
	}

	$ext = explode('.', $img);
	$ext = $ext[count($ext)-1];
	if (strtolower($ext) != "jpg")
	{
		die ("Error: File must be JPEG");
	}

	$src_img = ImageCreateFromJPEG($imgdir.$img);

	$org_h = imagesy($src_img);
	$org_w = imagesx($src_img);

	$tn_h = floor($tn_w * $org_h / $org_w);

	//digunakan untuk membuat standar tinggi / lebar max sesuai dengan lebar
	if($org_h > $org_w)
	{
		$temp_tn_w=$tn_h;
		$tn_h=$tn_w;
		$tn_w=floor($tn_h * $org_w / $org_h);
	}

	//gunakan imagecreate bila gd ver. 1 atau ImageCreateTrueColor bila gd ver. 2
	//if($accNya == "lokal") $dst_img = ImageCreate($tn_w,$tn_h);
	$dst_img = ImageCreateTrueColor($tn_w,$tn_h);

	ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $tn_w, $tn_h, $org_w, $org_h);

	ImageJPEG($dst_img, $tndir.$img);

	$gambar=printf ("<a href=\"%s\"><img src=\"%s\" alt=\"Click to view the original image\" border=0></a>", $imgdir.$img, $tndir.$img);
	//$kkk="width=".$tn_w." height=".$tn_h;
	return $gambar;
}

Function bikinThumbnail2($gaFile,$gDir,$gSize,$gPath)
{
	global $accNya;

	if (!isset($img))
	{
		$img = $gaFile;
	}
	$imgdir = $gDir;

	$tndir = $gPath;

	$tn_w = $gSize;
	if (!file_exists($imgdir.$img))
	{
		echo $imgdir.$img;
		die ("Error: File not found...");
	}

	$ext = explode('.', $img);
	$ext = $ext[count($ext)-1];
	if (strtolower($ext) != "jpg")
	{
		die ("Error: File must be JPEG");
	}

	$src_img = ImageCreateFromJPEG($imgdir.$img);

	$org_h = imagesy($src_img);
	$org_w = imagesx($src_img);

	$tn_h = floor($tn_w * $org_h / $org_w);

	//digunakan untuk membuat standar tinggi / lebar max sesuai dengan lebar
	if($org_h > $org_w)
	{
		$temp_tn_w=$tn_h;
		$tn_h=$tn_w;
		$tn_w=floor($tn_h * $org_w / $org_h);
	}

	//gunakan imagecreate bila gd ver. 1 atau ImageCreateTrueColor bila gd ver. 2
	//if($accNya == "lokal") $dst_img = ImageCreate($tn_w,$tn_h);
	$dst_img = ImageCreateTrueColor($tn_w,$tn_h);

	ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $tn_w, $tn_h, $org_w, $org_h);

	ImageJPEG($dst_img, $tndir.$img);

	//$gambar=printf ("<a href=\"%s\"><img src=\"%s\" alt=\"Click to view the original image\" border=0></a>", $imgdir.$img, $tndir.$img);
	//$kkk="width=".$tn_w." height=".$tn_h;
	return $gambar;
}

function namaFileNya($aaa)
{
	$f = strrev($aaa);
	$ext = substr($f, 0, strpos($f,"/"));
	$fileNya = strrev($ext);
	return $fileNya;
}

Function blokKata($kataBlok,$kalimatBlok)
{
	$kataBlok= str_replace(chr(34),"",$kataBlok);
	$kataBlok= explode(" ",trim($kataBlok));

	for($a=0; $a < count($kataBlok);$a++)
	{
		if(strlen($kataBlok[$a]) > 1)
		{
			$posisiKata=strpos(strtoupper($kalimatBlok),strtoupper($kataBlok[$a]));
			if(is_numeric($posisiKata))
			{
				$kata_yg_di_Blok=substr($kalimatBlok,$posisiKata,strlen($kataBlok[$a]));
				$kalimatBlok=str_replace($kata_yg_di_Blok,"<b>$kata_yg_di_Blok</b>",$kalimatBlok);
			}
		}
	}
	return $kalimatBlok;
}
Function tengahKata($kataCari,$tengahKata)
{
	if(strlen($tengahKata) < 200)
	{
		$tengahKata=substr($tengahKata,0,strlen($tengahKata))." ...";
	}
	if(strlen($tengahKata) > 200)
	{
		$xNya=strpos(strtoupper($tengahKata),strtoupper($kataCari));

		if($xNya < 100)
		{
			$cari_spasi_akhir = strpos($tengahKata," ",$xNya + 100);
			$tengahKata=substr($tengahKata,0,$cari_spasi_akhir)." ...";
		}
		if($xNya > 100)
		{
			$cari_spasi_awal = strpos($tengahKata," ",$xNya - 100);
			$zNya = ($xNya - 100)- $cari_spasi_awal;
			if((strlen($tengahKata)- $xNya) > 100)
			{
				$cari_spasi_akhir = strpos($tengahKata," ",$xNya + 100)+ $zNya;
				$jmlKataSemua=$cari_spasi_akhir - $cari_spasi_awal;
			}
			if((strlen($tengahKata)- $xNya) <= 100)
			{
				$jmlKataSemua=strlen($tengahKata) - $cari_spasi_awal;
			}
			$tengahKata="... ".substr($tengahKata,$cari_spasi_awal,$jmlKataSemua+2)." ...";
		}
	}
	return	$tengahKata;
}


Function kotakError($pesanNya)
{
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"90%\" align=\"center\">";
	echo "<tr><td align=\"left\" class=\"kotak_error\" valign=\"middle\">";
	//echo "Maaf, ada kesalahan:<br>".$pesanNya;
	echo $pesanNya;
	echo "</td></tr></table>";
}

Function kotakInfo($pesanNya)
{
	echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
	echo "<tr><td align=\"left\" class=\"kotak_info\" valign=\"top\">";
	echo $pesanNya;
	echo "</td></tr></table><br>";
}

Function jmlPengunjungTotal()
{
	$tbMulai="tb200308";
	$thMulai="2003";
	$blMulai="8";
	$mulai = mktime(0,0,0,8,1,2003);
	$se = mktime(0,0,0,date("m"),1,date("Y"));
	$jmlTB=intval(DateDiff("d",$mulai,$se)/30);
	$jmlJPT=0;
	$jmlLoop=$blMulai+$jmlTB+1;
	for($i=$blMulai;$i < $jmlLoop;$i++)
	{
		$sqlJPT = "select * from tb".$thMulai.utk2Digit($blMulai);
		//echo $sqlJPT."<br>";
		$goJPT = mysql_query($sqlJPT);
		while($rs_JPT= mysql_fetch_array($goJPT)) {
			$jmlJPT=$jmlJPT+1;
		}
		$thMulai="2003";
		$blMulai=$blMulai+1;
		if($blMulai==12)
		{
			$blMulai=1;
			$thMulai=$thMulai+1;
		}
	}
	return $jmlJPT;
}

Function jmlPengunjungTotal2()
{
	$tbMulai="tb200308";
	$jmlJPT=0;
	$sqlJPT = "select * from ".$tbMulai;
	//echo $sqlJPT."<br>";
	$goJPT = mysql_query($sqlJPT);
	while($rs_JPT= mysql_fetch_array($goJPT)) {
		$jmlJPT=$jmlJPT+1;
	}
	return $jmlJPT;
}

Function jmlPengunjungHari()
{
	$tbMulai="tb".date("Y").date("m");
	$hariNya=date("d-m-Y");
	$sqlJPH = "select * from ".$tbMulai." where tanggal='".$hariNya."'";
	$goJPH = mysql_query($sqlJPH);
	$jmlJPH=0;
	while($rs_JPH= mysql_fetch_array($goJPH)) {
		$jmlJPH=$jmlJPH+1;
	}
	return $jmlJPH;
}

function formatAngka($arg)
{
	$objArgs = func_get_args();
	$nCount = count($objArgs);
	$formatAngka=number_format($objArgs[0],0,',','.');
	if($nCount==2)
	{
		$formatAngka=number_format($objArgs[0],$objArgs[1],',','.');
		if(substr($formatAngka,-3)=='000') $formatAngka=number_format($objArgs[0],0,',','.');
	}
	return $formatAngka;
}


/*
How to use:
$key = "PaSsWoRd";
$toencrypt = "Encrypt me!";
$crypt = new MD5Crypt;
$en $crypt->Encrypt($toencrypt,$key);
//encrypts but if i show you output, and you do the same exact words its probally going to be

differnt.
$de = $crypt->Decrypt($en,$key);
makes the value of $toencrypt

If you need any help with this just email me @ axilant07@yahoo.com or im me on AIM @ axilant
*/

class MD5Crypt{

	function keyED($txt,$encrypt_key)
	{
		$encrypt_key = md5($encrypt_key);
		$ctr=0;
		$tmp = "";
		for ($i=0;$i<strlen($txt);$i++){
			if ($ctr==strlen($encrypt_key)) $ctr=0;
			$tmp.= substr($txt,$i,1) ^

			substr($encrypt_key,$ctr,1);
			$ctr++;
		}
		return $tmp;
	}

	function Encrypt($txt,$key)
	{
		srand((double)microtime()*1000000);
		$encrypt_key = md5(rand(0,32000));
		$ctr=0;
		$tmp = "";
		for ($i=0;$i<strlen($txt);$i++)
		{
			if ($ctr==strlen($encrypt_key)) $ctr=0;
			$tmp.= substr($encrypt_key,$ctr,1) .
			(substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1));
			$ctr++;
		}
		return base64_encode($this->keyED($tmp,$key));
	}

	function Decrypt($txt,$key)
	{
		$txt = $this->keyED(base64_decode($txt),$key);
		$tmp = "";
		for ($i=0;$i<strlen($txt);$i++){
			$md5 = substr($txt,$i,1);
			$i++;
			$tmp.= (substr($txt,$i,1) ^ $md5);
		}
		return $tmp;
	}

	function RandPass()
	{
		$randomPassword = "";
		srand((double)microtime()*1000000);
		for($i=0;$i<8;$i++)
		{
			$randnumber = rand(48,120);

			while (($randnumber >= 58 && $randnumber <= 64)

			|| ($randnumber >= 91 && $randnumber <= 96))
			{
				$randnumber = rand(48,120);
			}

			$randomPassword .= chr($randnumber);
		}
		return $randomPassword;
	}

}

function cek_karakter($text) {
	global $global_karakter;
	for ($i = 0; $i < strlen($text); $i++) {
		if (!in_array($text[$i],$global_karakter)) return false;
	}
	return true;
}

function cek_only_karakter($text) {
	global $global_only_karakter;
	for ($i = 0; $i < strlen($text); $i++) {
		if (!in_array($text[$i],$global_only_karakter)) return false;
	}
	return true;
}

function header_kotak($argJudul)
{
	echo '
	<!--kotak mulai-->
	<table border="0" cellspacing="0" cellpadding="0" width="498">
	<tr>
	<td align="left" valign="top" width="498" height="38" class="bg_kontenatas">
	<table border="0" cellspacing="0" cellpadding="0" width="498">
	<tr>
	<td align="left" valign="middle" width="498" height="38"><span class="judul_hitam">&nbsp;&nbsp;<b>'.$argJudul.'</b></span></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" width="498">
	<tr>
	<td align="left" valign="top" width="498" height="38" class="bg_kontentengah">';
}

function footer_kotak()
{
	echo '
	</td>
	</tr>
	</table>

	<table border="0" cellspacing="0" cellpadding="0" width="498">
	<tr><td align="left" valign="top" width="498" height="17" class="bg_kontenbawah">&nbsp;</td></tr>
	</table>
	<!--kotak selesai-->';
}

function tempToCelsius ($fTemp, $prec=0)
{
	if (!isset($fTemp)) {
		return false;
	}
	$prec = (integer)$prec;
	$cTemp = (float)(($fTemp - 32) / 1.8 );
	return round($cTemp, $prec);
}

function tempToFahrenheit($cTemp, $prec=0)
{
	if (!isset($cTemp)) {
		return false;
	}
	$prec = (integer)$prec;
	$fTemp = (float)(1.8 * $cTemp) + 32;
	return round($fTemp, $prec);
}

function ambilFileGambar($strFile)
{
	$kataPatokan="images/upload/";
	$posAwal=strpos($strFile,$kataPatokan)+strlen($kataPatokan);
	if($posAwal > 15)
	{
		$posAkhir=strpos($strFile,".",$posAwal)+5;
		$ambilFileGambar=substr($strFile,$posAwal,($posAkhir - $posAwal));
	}
	$ambilFileGambar=str_replace('"',"",$ambilFileGambar);
	return $ambilFileGambar;
}

function func_buatFolder($dir)
{
	if (!file_exists ($dir))
	{
		if (@mkdir ($dir, TIPE_CHMOD))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}

function func_copyFolder($oldname, $newname)
{
	if (!is_dir($newname))
	{
		mkdir($newname, TIPE_CHMOD);
		chmod($newname, TIPE_CHMOD);
	}
	$dir = opendir($oldname);
	while($file = readdir($dir)){
		if ($file == "." || $file == "..")
		{
			continue;
		}
		func_copyFolder("$oldname/$file", "$newname/$file");
	}
	closedir($dir);
}


function func_tampilGambar($namafile)
{
	if (file_exists($namafile))
	{
		$ukuran2 = GetImageSize($namafile);
		if(strtolower(substr(trim($namafile),-4))==".swf")
		{
			echo '
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="'.$ukuran2[0].'" height="'.$ukuran2[1].'" id="final-upload12" align="middle">
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="movie" value="'.$namafile.'" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<embed src="'.$namafile.'" quality="high" bgcolor="#000000" width="'.$ukuran2[0].'" height="'.$ukuran2[1].'" name="hkjhkjhkds" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>';
		}
		else
		{
			echo '<img src="'.$namafile.'" width="'.$ukuran2[0].'" height="'.$ukuran2[1].'" border="0">';
		}
	}
}


// Fungsi-fungsi untuk kalender jawe mulai
Function namaWindu($namaWindu)
{
	if($namaWindu == 0) $namaWindu="Adi";
	if($namaWindu == 1) $namaWindu="Kuntara";
	if($namaWindu == 2) $namaWindu="Sengara";
	if($namaWindu == 3) $namaWindu="Sancaya";
	return $namaWindu;
}

Function tahunCandra($tahunCandra)
{
	if($tahunCandra == 1) $tahunCandra="Alip";
	if($tahunCandra == 2) $tahunCandra="Ehe";
	if($tahunCandra == 3) $tahunCandra="Jimawal";
	if($tahunCandra == 4) $tahunCandra="Je";
	if($tahunCandra == 5) $tahunCandra="Dal";
	if($tahunCandra == 6) $tahunCandra="Be";
	if($tahunCandra == 7) $tahunCandra="Wawu";
	if($tahunCandra == 8) $tahunCandra="Jimakir";
	return $tahunCandra;
}

Function jumlahHariTahunCandra($tahunCandra)
{
	$jumlahHariTahunCandra=354;
	if($tahunCandra == 2 || $tahunCandra == 4 || $tahunCandra == 8) $jumlahHariTahunCandra=355;
	return $jumlahHariTahunCandra;
}

Function jumlahHariBulanJawa($bulan,$tahunCandra)
{
	if($bulan == 1) $jumlahHariBulanJawa=30;
	if($bulan == 2) $jumlahHariBulanJawa=29;
	if($bulan == 2 AND $tahunCandra== 5) $jumlahHariBulanJawa=30;
	if($bulan == 3) $jumlahHariBulanJawa=30;
	if($bulan == 4) $jumlahHariBulanJawa=29;
	if($bulan == 5) $jumlahHariBulanJawa=30;
	if($bulan == 5 AND $tahunCandra== 5) $jumlahHariBulanJawa=29;
	if($bulan == 6) $jumlahHariBulanJawa=29;
	if($bulan == 7) $jumlahHariBulanJawa=30;
	if($bulan == 8) $jumlahHariBulanJawa=29;
	if($bulan == 9) $jumlahHariBulanJawa=30;
	if($bulan == 10) $jumlahHariBulanJawa=29;
	if($bulan == 11) $jumlahHariBulanJawa=30;
	if($bulan == 12) $jumlahHariBulanJawa=29;
	return $jumlahHariBulanJawa;
}

Function xBulanJawa($xBulanJawa)
{
	if($xBulanJawa == 1) $xBulanJawa="Sura";
	if($xBulanJawa == 2) $xBulanJawa="Sapar";
	if($xBulanJawa == 3) $xBulanJawa="Mulud";
	if($xBulanJawa == 4) $xBulanJawa="Bakdamulud";
	if($xBulanJawa == 5) $xBulanJawa="Jumadilawal";
	if($xBulanJawa == 6) $xBulanJawa="Jumadilakir";
	if($xBulanJawa == 7) $xBulanJawa="Rejeb";
	if($xBulanJawa == 8) $xBulanJawa="Ruwah";
	if($xBulanJawa == 9) $xBulanJawa="Pasa";
	if($xBulanJawa == 10) $xBulanJawa="Sawal";
	if($xBulanJawa == 11) $xBulanJawa="Dulkangidah";
	if($xBulanJawa == 12) $xBulanJawa="Besar";
	return $xBulanJawa;
}

function weton($strTgl)
{
	$jowo[0]="Kliwon";
	$jowo[1]="Legi";
	$jowo[2]="Pahing";
	$jowo[3]="Pon";
	$jowo[4]="Wage";
	$patokan=rubahKeUnix("1976-05-24");
	$patokan2=rubahKeUnix($strTgl);
	$beda=DateDiff("d",$patokan,$patokan2);
	if($beda < 0) $beda=$beda* -4;
	elseif($beda==0) $beda = 5;
	$weton = $jowo[(($beda - 1) % 5)];
	return $weton;
}


Function weton2($strTgl)
{
	//format YYYY-MM-DD
	$arr_Tgl=explode("-",$strTgl);

	if(intval($arr_Tgl[1]) == 1) $pengurang=4;
	if(intval($arr_Tgl[1]) == 1 && ($arr_Tgl[0] % 4) == 0) $pengurang=5;
	if(intval($arr_Tgl[1]) == 2) $pengurang=4;
	if(intval($arr_Tgl[1]) == 2 && ($arr_Tgl[0] % 4) == 0) $pengurang=5;

	if(substr($arr_Tgl[0],-2)=="00")
	{
		if(intval($arr_Tgl[1]) == 1) $pengurang=4;
		if(intval($arr_Tgl[1]) == 1 && ($arr_Tgl[0] % 400) == 0) $pengurang=5;
		if(intval($arr_Tgl[1]) == 2) $pengurang=4;
		if(intval($arr_Tgl[1]) == 2 && ($arr_Tgl[0] % 400) == 0) $pengurang=5;
	}

	if(intval($arr_Tgl[1]) == 3) $pengurang=2;
	if(intval($arr_Tgl[1]) == 4) $pengurang=2;
	if(intval($arr_Tgl[1]) == 5) $pengurang=3;
	if(intval($arr_Tgl[1]) == 6) $pengurang=3;
	if(intval($arr_Tgl[1]) == 7) $pengurang=4;
	if(intval($arr_Tgl[1]) == 8) $pengurang=4;
	if(intval($arr_Tgl[1]) == 9) $pengurang=4;
	if(intval($arr_Tgl[1]) == 10) $pengurang=5;
	if(intval($arr_Tgl[1]) == 11) $pengurang=5;
	if(intval($arr_Tgl[1]) == 12) $pengurang=1;
	$hasil=intval(intval(substr($arr_Tgl[0],-2)) / 4) + intval($arr_Tgl[1]) + intval($arr_Tgl[2]) - $pengurang;
	echo $hasil." % 5 = ".($hasil % 5)."<br>";
	$hasil = $hasil % 5;
	echo intval(intval(substr($arr_Tgl[0],-2)) / 4)." + ".intval($arr_Tgl[1])." + ".intval($arr_Tgl[2])." - ".$pengurang."<br>";
	echo $hasil."<br>";
	if($hasil < 0 ) $hasil=5 + $hasil;
	if(intval($arr_Tgl[0]) >= 1500 && intval($arr_Tgl[0]) <= 1699)
	{
		if($hasil==1) $weton2="Pahing";
		if($hasil==2) $weton2="Pon";
		if($hasil==3) $weton2="Wage";
		if($hasil==4) $weton2="Kliwon";
		if($hasil==5 || $hasil==0) $weton2="Legi";
	}
	elseif(intval($arr_Tgl[0]) >= 1700 && intval($arr_Tgl[0]) <= 1899)
	{
		if($hasil==1) $weton2="Legi";
		if($hasil==2) $weton2="Pahing";
		if($hasil==3) $weton2="Pon";
		if($hasil==4) $weton2="Wage";
		if($hasil==5 || $hasil==0) $weton2="Kliwon";
	}
	elseif(intval($arr_Tgl[0]) >= 1900 && intval($arr_Tgl[0]) <= 2099)
	{
		if($hasil==1) $weton2="Kliwon";
		if($hasil==2) $weton2="Legi";
		if($hasil==3) $weton2="Pahing";
		if($hasil==4) $weton2="Pon";
		if($hasil==5 || $hasil==0) $weton2="Wage";
	}
	return $weton2;
}

Function func_hari($strTgl)
{
	//format YYYY-MM-DD
	$arr_Tgl=explode("-",$strTgl);

	if(intval($arr_Tgl[1]) == 1) $pengurang=2;
	if(intval($arr_Tgl[1]) == 1 && ($arr_Tgl[0] % 4) == 0) $pengurang=3;
	if(intval($arr_Tgl[1]) == 2) $pengurang=7;
	if(intval($arr_Tgl[1]) == 2 && ($arr_Tgl[0] % 4) == 0) $pengurang=1;

	if(substr($arr_Tgl[0],-2)=="00")
	{
		if(intval($arr_Tgl[1]) == 1) $pengurang=2;
		if(intval($arr_Tgl[1]) == 1 && ($arr_Tgl[0] % 400) == 0) $pengurang=3;
		if(intval($arr_Tgl[1]) == 2) $pengurang=7;
		if(intval($arr_Tgl[1]) == 2 && ($arr_Tgl[0] % 400) == 0) $pengurang=1;
	}

	if(intval($arr_Tgl[1]) == 3) $pengurang=1;
	if(intval($arr_Tgl[1]) == 4) $pengurang=6;
	if(intval($arr_Tgl[1]) == 5) $pengurang=5;
	if(intval($arr_Tgl[1]) == 6) $pengurang=3;
	if(intval($arr_Tgl[1]) == 7) $pengurang=2;
	if(intval($arr_Tgl[1]) == 8) $pengurang=7;
	if(intval($arr_Tgl[1]) == 9) $pengurang=5;
	if(intval($arr_Tgl[1]) == 10) $pengurang=4;
	if(intval($arr_Tgl[1]) == 11) $pengurang=2;
	if(intval($arr_Tgl[1]) == 12) $pengurang=1;
	$hasil=intval(substr($arr_Tgl[0],-2)) + intval(intval(substr($arr_Tgl[0],-2)) / 4) + intval($arr_Tgl[1]) + intval($arr_Tgl[2]) - $pengurang;
	echo $hasil." % 7 = ".($hasil % 7)."<br>";
	$hasil = $hasil % 7;
	echo intval(substr($arr_Tgl[0],-2))." + ".intval(intval(substr($arr_Tgl[0],-2)) / 4)." + ".intval($arr_Tgl[1])." + ".intval($arr_Tgl[2])." - ".$pengurang."<br>";
	echo $hasil."<br>";
	if($hasil < 0 ) $hasil=7 + $hasil;
	if((intval($arr_Tgl[0]) >= 1500 && intval($arr_Tgl[0]) <= 1599) or (intval($arr_Tgl[0]) >= 2000 && intval($arr_Tgl[0]) <= 2099))
	{
		if($hasil==1 || $hasil==0) $func_hari="Senin";
		if($hasil==2) $func_hari="Selasa";
		if($hasil==3) $func_hari="Rabu";
		if($hasil==4) $func_hari="Kamis";
		if($hasil==5) $func_hari="Jumat";
		if($hasil==6) $func_hari="Sabtu";
		if($hasil==7) $func_hari="Minggu";
	}
	elseif(intval($arr_Tgl[0]) >= 1600 && intval($arr_Tgl[0]) <= 1699)
	{
		if($hasil==1 || $hasil==0) $func_hari="Minggu";
		if($hasil==2) $func_hari="Senin";
		if($hasil==3) $func_hari="Selasa";
		if($hasil==4) $func_hari="Rabu";
		if($hasil==5) $func_hari="Kamis";
		if($hasil==6) $func_hari="Jumat";
		if($hasil==7) $func_hari="Sabtu";
	}
	elseif(intval($arr_Tgl[0]) >= 1700 && intval($arr_Tgl[0]) <= 1799)
	{
		if($hasil==1 || $hasil==0) $func_hari="Jumat";
		if($hasil==2) $func_hari="Sabtu";
		if($hasil==3) $func_hari="Minggu";
		if($hasil==4) $func_hari="Senin";
		if($hasil==5) $func_hari="Selasa";
		if($hasil==6) $func_hari="Rabu";
		if($hasil==7) $func_hari="Kamis";
	}
	elseif(intval($arr_Tgl[0]) >= 1800 && intval($arr_Tgl[0]) <= 1899)
	{
		if($hasil==1 || $hasil==0) $func_hari="Kamis";
		if($hasil==2) $func_hari="Jumat";
		if($hasil==3) $func_hari="Sabtu";
		if($hasil==4) $func_hari="Minggu";
		if($hasil==5) $func_hari="Senin";
		if($hasil==6) $func_hari="Selasa";
		if($hasil==7) $func_hari="Rabu";
	}
	elseif(intval($arr_Tgl[0]) >= 1900 && intval($arr_Tgl[0]) <= 1999)
	{
		if($hasil==1 || $hasil==0) $func_hari="Selasa";
		if($hasil==2) $func_hari="Rabu";
		if($hasil==3) $func_hari="Kamis";
		if($hasil==4) $func_hari="Jumat";
		if($hasil==5) $func_hari="Sabtu";
		if($hasil==6) $func_hari="Minggu";
		if($hasil==7) $func_hari="Senin";
	}
	return $func_hari;
}
// Fungsi-fungsi untuk kalender jawe selesai

function check_word($my_word)
{
	global $bad_words;
	$my_word=strtolower($my_word);
	$my_word=strip_tags($my_word);
	$my_word=trim($my_word);
	$my_word=explode(" ",$my_word);
	$check_word=0;
	for($a=0; $a < count($bad_words); $a++)
	{
		if(in_array($bad_words[$a],$my_word))
		{
			$check_word=1;
		}
	}
	return $check_word;
}

function cTime($strTgl) {
	
	$arr = explode("-",$strTgl);
	
	$times = @mktime("","","",$arr[1],$arr[0],$arr[2]);
	
	return $times;
	
}

function cTgl($strTgl,$t) {
	
	$arr = explode("-",$strTgl);
	
	if($t == 'yes') {
		$arr[2] = $arr[2] + 1;
	}
	
	/*$times = mktime("","","",$arr[1],$arr[0],$arr[2]);
	
	$hsl = date("Y-m-d",$times);*/
	
	$hsl = $arr[2].'-'.$arr[1].'-'.$arr[0];
	
	return $hsl;
	
}

function log_banner($id="",$radioId="") {

	global $conn;

	$sql = "INSERT INTO banner_log(id_banner,tgl,ip,id_radio) 
		VALUES(
			'".$id."',
			now(),
			'".$_SERVER['REMOTE_ADDR']."',
			'".$radioId."'
		)	 ";
	
	//'".date("Y-m-d h:i:s")."',
	
	mysql_query($sql,$conn);
}

function setStatistik(){
	
	if(date("d") == '01'){
		echo "masuk";
	}else{
		echo "tidak";
	}
	
}

?>
