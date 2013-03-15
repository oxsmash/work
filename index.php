<?php

//header("location:index.php");
//exit;

//ob_start();
session_start();
include("inc/fungsi.php");
include("inc/config.php");

$cKode=utk5Digit(rand(1,32768));
$crypt = new MD5Crypt;
$hKode = $crypt->Encrypt($cKode,key_generator);

if (!isset($_SESSION["radioSession"])) {
	$_SESSION['radioSession'] = $hKode;
	$_SESSION['sessionCode'] = $cKode;
	$_SESSION['radio_klik'] = array();
}

$rs=mysql_query("select * from cni_streamer where status='1' and id='1'");
$row=mysql_fetch_array($rs);
$cuplikan=putusKalimat($row[isi],300);
$idwelcome = $row[id];


$sqlMerapi2 = "SELECT * FROM ".cni_berita." where status_berita=1 ORDER BY berita_id DESC limit 3";
$resMerapi2 = mysql_query($sqlMerapi2);

// $folderNya="images/banner/";
/*$sql_text = "select * from ".cni_banner." where status_banner='1' and letak_banner='3' group by banner_id DESC limit 4";

$sql=mysql_query($sql_text);*/

if(!empty($_GET['play'])) {

	$cmd100 =   "INSERT INTO statistik(id_radio,tgl,referer,ip) 
			VALUES(
				'".$_GET['play']."',
				now(),
				'".$_SERVER['HTTP_REFERER']."',
				'".$_SERVER['REMOTE_ADDR']."'
			)";
	//'".date("Y-m-d h:i:s")."',
	
	
	//mysql_query($cmd100) or die();
	
	

if (! isset($_COOKIE["PHPSESSID"]) && ! isset($_GET["PHPSESSID"]))
{  
  $cookies_disabled = "1";
}
elseif (! isset($_COOKIE["PHPSESSID"]) && isset($_GET["PHPSESSID"]))
{  
  $cookies_disabled = "1";
}
else
{
  $cookie_disabled = "0";
}
	

if($cookie_disabled == "0")	
	{
	
	if(!in_array($_GET['play'],$_SESSION['radio_klik']))
		{
		array_push($_SESSION['radio_klik'],$_GET['play']);
		
		$jumlahHIT = cekJumlahHit($_GET['play']);
		if($jumlahHIT < 20)
			{
			setStatistik($_GET['play']);
			rankingHarian($_GET['play']);
			}
		}
	}
}

$timeHariIni = date("Y-m-d");
							
	//echo $timeHariIni;

$cmdBannerBawah = "SELECT * FROM cni_banner 
				WHERE letak_banner = '4' 
				AND status_banner = '1' 
				AND (selesai_banner >= '".$timeHariIni."'   
					AND mulai_banner <= '".$timeHariIni."')
				AND (limit_banner > jumlah_show)
				AND tgl_show = '".$timeHariIni."'   
				ORDER BY rand() 
				
				
				";

//echo $cmdBannerBawah;

$resBannerBawah = mysql_query($cmdBannerBawah);		

if(mysql_num_rows($resBannerBawah) < 1) {

	$cmdUpdate1 = "UPDATE cni_banner SET 
					jumlah_show = '0',
					tgl_show = '".$timeHariIni."' 
					WHERE tgl_show < '".$timeHariIni."' 
						";
					
					
	mysql_query($cmdUpdate1);	
}

include "inc/adhy.php";
?>
<div style="position:fixed; 
margin-top: -100px;
top: 50%;
-moz-border-radius:5px;
-webkit-border-radius:5px;
-khtml-border-radius:5px;
border-radius: 5px;
background: #ffffff;
padding: 5px;
width:50px;
height: 120px;
color: #ff0000;
z-index:100;">

<a href="https://twitter.com/jogjastreamers" target="_blank">
<img src="images/twbawah.png"/>
</a>
<br/>
<a href="https://www.facebook.com/jogjastreamers" target="_blank">
<img src="images/fbbawah.png"/>
</a>
<br/><br/>
<?=getSocialMediaUI();?>
</div>
<div id="container" style="margin-top: -20px;">
<div id="content">
<table width="960" border="0" cellpadding="0" cellspacing="25" class="banner">
<tr>
	<td><img src="images/banner/1250076418.jpg" /></td>
    <td><img src="images/banner/baner-citranet3.jpg" /></td>
							</tr>
</table>

<table width="980" border="0" cellpadding="0" cellspacing="0" style="margin-top:-25px" class="m-box">
<tr>
					<td width="25%" valign="top">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td valign="top" align="center">
								
								</td>
							</tr>
</table>

			<table width="980" class="main-container" border="0" cellpadding="0" cellspacing="0" align="center" style="padding:15px 8px 0 8px;"  <?=$bg3?> >
				<tr>
				
					<!-- Left bar -->
					<td width="25%" valign="top" class="left-bar">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td valign="top" align="center">
								<div style="background: #FF0000; padding: 5px;text-align: left; font-size:16px;">STATION LIST</div>
						        <div id="station_widget" style="padding: 5px;text-align: left;border-bottom:1px #FFF solid;">	
									
									<?
								$cmd = "Select * from radio where status=1 order by nama ";
								//echo $cmd;
								$result=mysql_query($cmd) or die();
								while($rs=mysql_fetch_array($result)){
								?>
									<li><a id="station" class="pointer" onClick="loadRadioDetail('<?=$rs['radio_id']?>')"><?=$rs['nama']?></a></li>
								<? }?>
								</div>	
								</td>
							</tr>
						</table>
					</td>
					
				<!-- main content -->
		        <td width="50%" valign="top" class="main-content">				
				  <div style="width:100%; float:left;">
                  <img src="images/banner/1308641807.gif"  class="bannertengah"/>
                   <img src="images/banner/1340790751.png" class="bannertengah"/>
                  </div>
                  </td>
					
					<!-- right bar -->
		            <td width="25%" valign="top" class="right-bar">					
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td valign="top" align="center">
						        <div class="twitter-holder" style="padding: 5px;text-align: left;">	
								<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
  new TWTR.Widget({
  version: 2,
  type: 'search',
  search: '@jogjastreamers',
  interval: 6000,
  subject: '@jogjastreamers',
  width: 230,
  height: 250,
  theme: {
    shell: {
      background: '#FF0000',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#9ABF4D'
    }
  },
  features: {
    scrollbar: false,
    loop: true,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    toptweets: true,
    behavior: 'default'
  }
}).render().start();
</script>
								</div>	
								</td>
	                        </tr>
						</table>
					</td>
                 </tr>
<br/>
<table class="banner-bottom" width="960" border="0" cellpadding="0" cellspacing="0" style="background: #000000;margin-top: 5px;">
<tr>
<td width="960" bgcolor="#000000" align="center">
<img src="images/banner/mitsubishi_06.jpg" class="banneratasfooter"/>
</td>
</tr>
</table>
<br/>

</table>
</td>
</tr>
</table>
</div>
</div>
<br/>
<?php
include "inc/footer2.php";
?>
