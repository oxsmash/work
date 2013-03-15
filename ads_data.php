<?php

if ($_POST) {
	include_once("inc/fungsi.php");
	include_once("inc/config.php");
	include_once('inc/function_ip.php');
	
	$id = $_POST['id'];
	
	// select 1 random ads here
	$adsDir = "images/banner/";
	$ads = "";
	
	if (is_numeric($id) && $id>0) {
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
	}

	print "txt_ads2=".$ads;
	exit;
}

?>