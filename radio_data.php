<?php

/*
arrServer[0] = "http://usa.jogjastreamers.com:8282/"; // international
arrServer[1] = "http://jkt.jogjastreamers.com:8000/"; // jakarta
arrServer[2] = "http://jgj.jogjastreamers.com:8000/"; // jogjakarta
*/

session_start();

if ($_GET) {
	include_once("inc/fungsi.php");
	include_once("inc/config.php");
	include_once('inc/function_ip.php');
	
	$id = $_GET['id'];
	$stereo = $_GET['stereo'];
	if ($stereo!="1") $stereo = "0";
	
	$mount = "zxa";
	$radio = "NonExist Radio";
	$server = "";
	$adsDir = "images/banner/";
	$ads = "";
	$teks_status = "";
	
	// check IP disini
	if (is_numeric($id) && $id>0) {
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
		
		// determine server
		$sql = "select * from ".tabel_url." order by id";
		$res = mysql_query($sql,$conn);
		$arrURL = array();
		while ($row = mysql_fetch_object($res)) {
			$arrURL[$row->area] = $row->url;
		}
		mysql_free_result($res);

		$ippengguna = $_SERVER['REMOTE_ADDR'];
		//$ippengguna = "219.182.212.54"; // internasional
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
		$f = fopen('ip1.txt', "r");
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
		
		// get radio information		
		$cmdRadio = "SELECT r.*, k.kota FROM radio r, t_kota k WHERE r.status = 1 and r.radio_id = '".$id."' and r.id_kota = k.id_kota";
		$res = mysql_query($cmdRadio,$conn);
		$row = mysql_fetch_object($res);
		$radio	= $row->nama;
		$kota	= $row->kota;
		$mount	= $row->mount;
		$status_tambahan = $row->status_tambahan;

		if ($status_tambahan=="1") {
			$teks_status = "Under Maintenance!";
		}
		
		if ($stereo=="1" && $row->stereo=="1") {
			$stereo = "1";
			$mount .= "stereo";
		} else {
			$stereo = "0";
		}
	}
	
	$modeAuth = "xfile";
	
	if($modeAuth=="file") {
		// create file
		$fh = fopen("temp/".$_SERVER["REMOTE_ADDR"]."_".str_replace("/","",$mount).".txt", "w");
		fclose($fh);
	} else {
		if (!isset($_SESSION["sessionCode"])) {
			$cKode=utk5Digit(rand(1,32768));
			$_SESSION['sessionCode'] = $cKode;
		}
		
		// $server = $arrURL['jakarta'];
		// $server = $arrURL['international'];
		
		$sql2 = "insert into tb_zpendengar set server='".$server."', session_id='".$_SESSION['sessionCode']."', tgl=now()";
		mysql_query($sql2);	
		$mount .= "?s=".$_SESSION['sessionCode'];
	}	
	
	//print "txt_check=".$server."&txt_mount=".$mount."&txt_radio=".$radio."&txt_kota=".$kota."&txt_sm=".$stereo."&txt_ads=".$ads."&txt_status_tambahan=".$teks_status;
	// $data= array('txt_check' => $server,'txt_mount' => $mount,'txt_radio' => $radio,'txt_kota' => $kota,'txt_sm' => $stereo, 'txt_ads' => $ads, 'txt_status_tambahan' => $teks_status);
	//echo json_encode($data);
?>  
<script>
//$('audio,video').mediaelementplayer({features: ['volume','playpause','current'],audioWidth: 290,audioHeight: 30,});
var player = new MediaElementPlayer('audio,video', {
    startVolume: 0.8,
    features: ['volume','current'],
	iPadUseNativeControls: false,
    iPhoneUseNativeControls: false,
    AndroidUseNativeControls: false,
	pauseOtherPlayers: true,
    autoplay: true,
    audioWidth: 130,
    audioHeight: 30
    }
);
player.play();

<?
$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
if ($isiPad=='1'){
?>
$.ajax({
	  url: "tombol.php?tombol=ipad",
	  cache: false,
	  success: function(html){
		loadhid();
		$("#tomblo").html(html);
	  }
	});
<?
}
?>
function playlho(){
player.pause();
player.play();
$.ajax({
	  url: "tombol.php?tombol=play",
	  cache: false,
	  success: function(html){
		loadhid();
		$("#tomblo").html(html);
	  }
	});
}


function stoplho(){
player.pause();
$.ajax({
	  url: "tombol.php?tombol=pause",
	  cache: false,
	  success: function(html){
		loadhid();
		$("#tomblo").html(html);
	  }
	});
}


</script>
 <div class="newfooter">
	   <img src="images/mike.jpg" style="margin-left: 5px; margin-top: 10px;"/>
		 <div class="playerlho">
           <div style="position:absolute; color:#FFFFFF; margin-left: 5px; z-index: 100;"> Player</div>

                <!-- Garis pemisah kiri is here-->
                <div style="position:absolute; color:#FFFFFF; margin-left: -7px; margin-top:7px; z-index: 100;"> 
                <img src="images/pembagi.jpg" />
                </div>
                <!-- Garis pemisah kanan is here-->
            
                <div style="position:absolute; color:#FFFFFF; margin-left: 256px; margin-top:7px; z-index: 100;"> 
                <img src="images/pembagi.jpg" />
                </div>
            
                <!-- Banner is here-->
                <div class="bannerfooternew"> 
                <img src="images/banner/dummy.jpg" />
                </div>
                <!-- End Banner is here-->


				<audio id="player2" src="<?=$urlNya?>e.mp3" type="audio/mp3" autoplay>	</audio>
                <div id="tomblo" style=" margin-top: 10px; margin-left: 150px; position:absolute; z-index: 200;">
					<a><img src="images/playh.png" /></a>&nbsp;<a onclick="stoplho()"><img src="images/stop.png" /></a>
                    </div>
		  </div> <!--End playerlho-->
	</div> <!--end newfooter-->

	<div class="citrawebfoot">
		<span class="abu f-13 citrarespon">Copyright &copy; 2013. Jogja Streamers. All Rights Reserved. :: Powered by <a href="http://citra.web.id/" target="_blank">Citraweb Nusa Infomedia</a>
        </span>
		<span class="abu f-13 mobileapptext" style="margin-left: 250px">Mobile Aplication :</span>
		<a href="https://play.google.com/store/apps/details?id=id.web.citra.jogjastreamers" target="_blank">
		<img src="images/andriod.png" style="position:absolute; margin-top: -5px;"/></a>&nbsp;&nbsp;&nbsp;
		<a href="http://appworld.blackberry.com/webstore/content/116949" target="_blank">
		<img src="images/bbico.png" style="position:absolute; margin-left: 20px; margin-top: -5px;"/></a>
		&nbsp;&nbsp;&nbsp;
		<a href="http://itunes.apple.com/br/app/jogjastreamers/id411884480?mt=8" target="_blank"><img src="images/apple.png" style="position:absolute; margin-left: 50px; margin-top: -5px;"/></a>
	</div>
<!--<table cellpadding="0" cellspacing="0" style="background: #424242; 
	border-top-left-radius:5px; border-top-right-radius: 5px">
<tr>
<td valign="top" width="30"><img src="images/mike.jpg" style="margin-left: 5px; margin-top: 2px;"/></td>
<td valign="top" width="360">
<table>
<tr>
<td>
<img src="images/logo/<?//$_GET['id']?>.jpg" width="100" height="40" style="border: 1px solid #ffffff"/>
</td>
<td>
<table>
<tr>
<td>Now Playing:</td>
</tr>
<tr>
<td>
<?//$radio?>

</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td valign="top" width="290">
<table cellpadding="0" width="290px" cellspacing="0" style="border: 1px solid #666666;-moz-border-radius:5px;
    -webkit-border-radius:5px;
    -khtml-border-radius:5px;
    border-radius: 5px;background: #161616">
<tr>
<td>&nbsp;<?//if ($stereo=="1"){ echo "Stereo";}else{ echo "Mono";}?></td>
<td rowspan="2"><img src="images/play.png" onclick="playtest()"/>&nbsp;<img src="images/stop.png" onclick="pausetest()"/></td>
</tr>
<tr>
<td>
<audio id="player2" src="http://web2.web/1300_jogjastreamers/work/e.mp3 <?//$server.$mount?>" type="audio/mp3" autoplay>	
</audio>
</td>
</tr>
</table>
</td>
 <td>
<img src="images/banner/1358911591.jpg" width="100%" class="bannerfooter"/>
</td>   
</tr>
</table>--!>
	<?exit;
}

?> 


