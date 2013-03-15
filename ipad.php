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
	
	
	mysql_query($cmd100) or die();

}

$timeHariIni = date("Y-m-d");
							
	//echo $timeHariIni;

$cmdBannerBawah = "SELECT * FROM cni_banner 
				WHERE letak_banner = '2' 
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



?>

<html>
<head>
<title>JOGJA STREAMERS</title>

<?php
include "inc/header2.php";
?>
			<td width="60%" align="center" valign="top"  style="padding:0 15px 0 15px;">
						
					<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fff" >	
						<tr>
							<td style="background:url(images/kotakkratas.jpg) top left no-repeat;width:6px;"></td>
							<td class="putih f-11" height="25" align="left" style="background:url(images/kotaktnatas.jpg) repeat-x;width"><b>RADIO STATION LIST</b></td>
							<td class="putih f-12" height="25" align="right" style="background:url(images/kotaktnatas.jpg) repeat-x;"><b><span id="kt">Semua</span></b></td>
							<td style="background:url(images/kotakknatas.jpg) top right no-repeat;width:6px;"></td>
						</tr>
						
					</table>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#3A3A3A">
						<tr>		
							<td colspan="4" style="border-left:1px solid #616161;border-right:1px solid #616161;">		
								<div id="radiobox" >
									<div id="radioboxall" ></div>
									<div id="radioboxscroll" style="height:140px;overflow:auto;display:none;"></div>
								</div>	
							</td>
						</tr>
						<tr>
							<td style="background:url(images/kotakkrbwh.jpg) top left no-repeat;width:6px;height:11px;"></td>
							<td colspan="2" style="border-bottom:1px solid #616161;height:11px;"></td>
							<td style="background:url(images/kotakknbwh.jpg) top right no-repeat;width:5px;"></td>
						</tr>
						</table>
						<br>
						<div id="loading" style="display:none;"><img src="images/blue-loading.gif"></div>
						<div id="hal" style="display:block;"></div>
					</td>
					<td width="5%" align="right" valign="top">
						<img src="images/spacer.gif" width="167" height="1">
						
						<?php 
						
						$cmdBannerKanan = "SELECT * FROM cni_banner 
							WHERE letak_banner = '3' 
							AND status_banner = '1' 
							AND (selesai_banner >= '".$timeHariIni."'   
								AND mulai_banner <= '".$timeHariIni."')
							AND (limit_banner > jumlah_show)
							AND tgl_show = '".$timeHariIni."'
							ORDER BY rand() 
							LIMIT 8
							
							";

						$resBannerKanan = mysql_query($cmdBannerKanan);		
						$iJoin = 0;
						$arrJoin = array();
						while($res=mysql_fetch_assoc($resBannerKanan)){ 
											
							$link = "";

							if (trim($res['link_banner'])=="loadJoin()") {
								$link = 'onclick=loadJoin()';
								$arrJoin[$iJoin]['id'] = $res[banner_id];
								$arrJoin[$iJoin]['tipe'] = $res['tipe'];
								$arrJoin[$iJoin]['file'] = "images/banner/".$res[file_banner];
								$iJoin++;
								continue;
							} else {
								$link = 'onclick=window.open("klik_banner.php?id='.$res[banner_id].'");';
							}
							
							echo '<div style="padding-bottom:10px;">';
						
							if($res['tipe'] == 'application/x-shockwave-flash'  ) {
								
								$arrSwf = getimagesize("images/banner/".$res['file_banner']);
								$swfH = $arrSwf[1];
								$link = "";
								echo '
									<a '.$link.' >
										<embed class="pointer" name="flashfile" src="images/banner/'.$res['file_banner'].'" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="160" height="'.$swfH.'">
										</embed>
									</a>';
							
							}else {
								echo '<a '.$link.' class="pointer"><img border="0" src="images/banner/'.$res['file_banner'].'"></a>';
							}
							
							$cmdUpdateKanan = "UPDATE cni_banner SET 
												tgl_show = '".date("Y-m-d")."',
												jumlah_show = jumlah_show + 1 
												WHERE 	banner_id = '".$res[banner_id]."'";
												
							mysql_query($cmdUpdateKanan);	

							log_banner($res[banner_id]);			
							
							echo "</div>";
						}
						
						foreach($arrJoin as $value) {
							$link = 'onclick=loadJoin()';
							
							echo '<div style="padding-bottom:10px;">';
						
							if($value['tipe'] == 'application/x-shockwave-flash'  ) {
								$arrSwf = getimagesize($value['file']);
								$swfH = $arrSwf[1];
								$link = "";
								echo '
									<a '.$link.' >
										<embed class="pointer" name="flashfile" src="'.$value['file'].'" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="160" height="'.$swfH.'">
										</embed>
									</a>';
							
							}else {
								echo '<a '.$link.' class="pointer"><img border="0" src="'.$value['file'].'"></a>';
							}
							
							$cmdUpdateKanan = "UPDATE cni_banner SET 
												tgl_show = '".date("Y-m-d")."',
												jumlah_show = jumlah_show + 1 
												WHERE 	banner_id = '".$value['id']."'";
												
							mysql_query($cmdUpdateKanan);	

							log_banner($value['id']);			
							
							echo "</div>";
						} ?>
						
						
						
						
					</td>
				</tr>
				<tr>
					<td>&nbsp; </td>
				</tr>
				<tr>
					<td align="center" colspan="3" >
						
					</td>
				</tr>
			</table><br>
		</td>
	</tr>

<?php

include "inc/footer2.php";
?>