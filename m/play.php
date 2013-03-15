<?php
session_start();
include_once("../inc/fungsi.php");
include_once("../inc/config.php");
include_once('../inc/function_ip.php');

if ($_GET) {	
	$id = $_GET['id'];
	
	$mount = "zxa";
	$radio = "NonExist Radio";
	$server = "";
	$adsDir = "images/banner/";
	$ads = "";
	$teks_status = "";
	
	// check IP disini
	if (is_numeric($id) && $id>0) {
		/*
		// select 1 random ads here
		$timeHariIni = date("Y-m-d");
		$cmdBannerAudio = "SELECT * FROM cni_banner 
			WHERE letak_banner = '7' 
			AND (selesai_banner >= '".$timeHariIni."'   
			AND mulai_banner <= '".$timeHariIni."')
			AND (limit_banner > jumlah_show)
			AND tgl_show = '".$timeHariIni."'   
			ORDER BY rand() 
			";
		$resBannerAudio = mysql_query($cmdBannerAudio);
		if(mysql_num_rows($resBannerAudio) < 1) {
			$cmdUpdate = "UPDATE cni_banner SET 
				jumlah_show = '0',
				tgl_show = '".$timeHariIni."' 
				WHERE tgl_show < '".$timeHariIni."' 
				";
			mysql_query($cmdUpdate);
			$resBannerAudio = mysql_query($cmdBannerAudio);
		}	
		if(mysql_num_rows($resBannerAudio) < 1) {
			$ads = "";
		} else {
			$rowBannerAudio = mysql_fetch_object($resBannerAudio);
			$bannerAudioID  = $rowBannerAudio->banner_id;
			$bannerAudioFile= trim($rowBannerAudio->file_banner);
			$ads = $adsDir.$bannerAudioFile;
			
			$cmdUpdate2 = "UPDATE cni_banner SET 
				tgl_show = '".date("Y-m-d")."',
				jumlah_show = jumlah_show + 1 
				WHERE 	banner_id = '".$bannerAudioID."'";					
			mysql_query($cmdUpdate2);
			
			log_banner($bannerAudioID, $id);
		}
		*/
		
		/*
		// menyiapkan pembungkus server
		if ($_SERVER['SERVER_NAME']=="web-web") {
			$arrSelf = pathinfo($_SERVER['PHP_SELF']);
			$server = "http://".$_SERVER['SERVER_NAME'].$arrSelf['dirname']."/";
		} else {
			$server = "http://".$_SERVER['SERVER_NAME']."/";
		}
		$mount = "radio_listen.php?id=".$id;
		*/
		/*
		// determine server
		$sql = "select * from ".tabel_url." order by id";
		$res = mysql_query($sql,$conn);
		$arrURL = array();
		while ($row = mysql_fetch_object($res)) {
			$arrURL[$row->area] = $row->url;
		}
		mysql_free_result($res);

		$ippengguna = $_SERVER['REMOTE_ADDR'];
		//$ippengguna = "1.1.1.1"; // internasional
		//$ippengguna = "202.155.0.10"; // jakarta
		//$ippengguna = "202.65.112.2"; // jogja
		//$ippengguna = "123.223.153.252";
		$ippengguna_integer = ip2integer($ippengguna);

		// default.... server amerika
		$server = $arrURL['international'];

		// pemilihan server jakarta
		$cmd = "select * from tbiixjkt where numawal<=$ippengguna_integer AND numakhir>=$ippengguna_integer";
		$resX = mysql_query($cmd,$conn);
		if(mysql_num_rows($resX) > 0) {
			$server = $arrURL['jakarta'];
		}
		mysql_free_result($resX);

		// pemilihat server JOGJA
		$f = fopen('../ip1.txt', "r");
		if(!$f) continue;
		while(!feof($f)) {
				$buff = trim(fgets($f, 1024));
				if(empty($buff)) continue;
				$arr_buf = explode("/", $buff);
				if(is_in_subnet($arr_buf[0], $arr_buf[1], $ippengguna)) {  
					$server = $arrURL['jogjakarta'];
					break 1;
				}
		}
		fclose($f);
		*/
		
		// server always in usa
		$cmdServer = "SELECT url FROM tb_url WHERE id='1'";
		$resServer = mysql_query($cmdServer,$conn);
		$rowServer = mysql_fetch_object($resServer);
		$server	= $rowServer->url;		
		
		// get radio information		
		$cmdRadio = "SELECT r.*, k.kota FROM radio r, t_kota k WHERE r.status = 1 and r.radio_id = ".$id." and r.id_kota = k.id_kota";
		$res = mysql_query($cmdRadio,$conn);
		$row = mysql_fetch_object($res);
		$radio	= $row->nama;
		$kota	= $row->kota;
		$mount	= $row->mount."bb";
		$status_tambahan = $row->status_tambahan;
		
		if ($status_tambahan=="1") {
			$teks_status = "Under Maintenance!";
		}
	}
	
	// create file
	// fopen("temp/".$_SERVER['REMOTE_ADDR']."_".$mount.".txt", "w+");
	
	if(strlen($teks_status)>0) {
		include_once("header-m.php");
		echo $teks_status;
		include_once("footer-m.php");
	} else {
		header("location:".$server.$mount);
		exit;
		/*
		echo
		'<object type="audio/midi" data="'.$server.$mount.'">
			<param name="src" value="'.$server.$mount.'">
			<param name="autoplay" value="true">
			<param name="autoStart" value="1">
		</object>';
		*/
	}
}
?>