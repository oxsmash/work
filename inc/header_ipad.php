<?php
//ob_start();
//session_start();

include_once("../inc/config.php");
include_once("../inc/fungsi.php");

$def_radio = "";
if ($_GET) {
	$def_radio = "-1";
	
	$id = $_GET['play'];
	$isStereo = $_GET['mode'];
	if (is_numeric($id) && $id>0) {		
		$sql_def = "select * from ".tabel_radio." where radio_id='".$id."' and status='1'";
		$res_def = mysql_query($sql_def);
		$row_def = mysql_fetch_object($res_def);
		$nama = $row_def->nama;
		$mount = $row_def->mount;
		if (empty($nama) || empty($mount)) {
			$id_radio = "-1";
		} else {
			$id_radio = "$id";
		}
	}
	
	// REMOVE THIS LINE!!!
	if ($id=="100") {
		$id_radio = 100;
	}
	
	if ($isStereo!="1") {
		$isStereo = "0";
	}
	$def_radio = '<div style="color:#000;" id="id_radio">'.$id_radio.'</div><div style="color:#000;" id="stereo_radio">'.$isStereo.'</div>';
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
<link rel="Shortcut Icon" href="../js.ico" type="image/x-icon" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/swfobject.js"></script>
<script type="text/javascript" src="../js/jquery.corner.js"></script>
<script type="text/javascript" src="../js/center.js"></script>
<script type="text/javascript" src="../js/radiojs2.js"></script>
</head>
<body >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="105" align="center" bgcolor="#545454">
			<?php
				//$sqlHeader = "SELECT * FROM ".tabel_banner." WHERE status_banner = '1' AND letak_banner = '1' LIMIT 1 ";
				
				$sqlHeader = "SELECT * FROM cni_banner 
							WHERE letak_banner = '1' 
							AND status_banner = '1' 
							AND (selesai_banner >= '".$timeHariIni."'   
								AND mulai_banner <= '".$timeHariIni."')
							AND (limit_banner > jumlah_show)
							AND tgl_show = '".$timeHariIni."'   
							ORDER BY rand() 
							LIMIT 1
							
							";
				
	
				$hsl2 = mysql_query($sqlHeader);
				while($brsHeader = mysql_fetch_array($hsl2)) {					
					$link = "";
					if (trim($brsHeader['link_banner'])=="loadJoin()") {
						$link = 'onclick=loadJoin()';
					} else {
						$link = 'onclick=window.open("klik_banner.php?id='.$brsHeader[banner_id].'");';
					}
					
					if($brsHeader['tipe'] == 'application/x-shockwave-flash'  ) {
						$link = "";
						echo '
							<a '.$link.' >
								<embed class="pointer" name="flashfile" src="../images/banner/'.$brsHeader['file_banner'].'" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="673" height="94">
								</embed>
							</a>';
					
					}else {
						
						echo "<a ".$link." class='pointer'><img border='0' src='../images/banner/".$brsHeader['file_banner']."'></a>";
						
					}
					
					$cmdUpdateAtas = "UPDATE cni_banner SET 
												tgl_show = '".date("Y-m-d")."',
												jumlah_show = jumlah_show + 1 
												WHERE 	banner_id = '".$brsHeader[banner_id]."'";
												
					mysql_query($cmdUpdateAtas);	

					log_banner($brsHeader[banner_id]);
					
				}
			?>
		</td>
	</tr>
	<tr>
		<td height="123" align="center" bgcolor="#363636">
			<table width="870" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table width="870" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="383"><img src="../images/logojogjast.jpg"></td>
								<td width="477" style="background:url(images/logobg.jpg) repeat-x;" >
									<table width="80%" align="center" cellspacing="1" cellpadding="0" border="0" >
										<tr>
											<td><img src="../images/about.gif"></td>
											<td><img src="../images/what.gif"></td>
											<td align="left"><img src="../images/news.gif"></td>
										</tr>
										<tr>
											<td><a onclick="loadAbout();" class="hitam pointer"><b>ABOUT US</b></a></td>
											<td><a onclick="loadBerita('','');" class="hitam pointer"><b>NEWS</b></a></td>
											<td><a onclick="loadContact();" align="left" class="hitam pointer"><b>CONTACT US</b></a></td>
										</tr>
									</table>
								</td>
								<td width="16" style="background:url(images/logokanan.jpg) left no-repeat;">&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="middle" height="35">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="50%" align="left">
									<table width="60%" height="10" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td align="center" class="grskanan"><a onclick="loadHome('fast');" class="abu f-11 pointer">HOME</a> &nbsp;</td>
											<td align="center" class="grskanan"><a class="abu f-11 pointer" onclick="loadAdv();">ADVERTISEMENT</a> </td>
											<td align="center" ><a class="abu f-11 pointer" onclick="loadTerms();">TERMS & CONDITION</a> </td>
										</tr>
									</table>
								</td>
								<td align="right" width="26%"  class="hijau" >Radio Station By City </td>
								<td align="left" width="24%"  >&nbsp;
									<select name="slcity" id="slcity" class="f-12 combo" onchange="loadRadioList('' +this.options[this.selectedIndex].value + '',''+this.options[this.selectedIndex].text+'');">
										<option value="">Semua </option>
										<?php
											$sqlKota = "SELECT DISTINCT a.id_kota,kota FROM t_kota a,radio b 
														WHERE	a.status = '1' 
														AND		a.id_kota = b.id_kota 
														ORDER BY a.id_kota ASC";
											
											$resKota = mysql_query($sqlKota);
											
											while($barisKota = mysql_fetch_array($resKota)) {
												
												echo "<option value='".$barisKota['id_kota']."' >".$barisKota['kota']."</option>";
												
											}
											
										?>
										
									</select>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center" >
			<table width="870" border="0" cellpadding="0" cellspacing="0" align="center" style="margin-top:15px;"  >
				<tr>
					<td width="25%" valign="top">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td valign="top" align="center">
									<?php echo $def_radio; ?>
									<div id="xswf">
										<div id="altText" style="text-align:center;margin:1px;">
											Jogjastreamers radio player require flash player 10 or later to run.<br/><br/>
											<a href="http://www.adobe.com/go/getflashplayer">
												<img border="0" src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
											</a>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<div style="padding-top:4px;" id="request" class="abu"><a class="pointer" onclick="loadRequest();"><img src="images/request.jpg"></a></div>
									<br/>
								</td>
							</tr>
							<tr>
								<td valign="top">
								
									<?php
										//$sqlFooter = "SELECT * FROM ".tabel_banner." WHERE status_banner = '1' AND letak_banner = '4' LIMIT 1 ";
										
										 $sqlBanKiri = "SELECT * FROM cni_banner 
											WHERE letak_banner = '4' 
											AND status_banner = '1' 
											AND (selesai_banner >= '".$timeHariIni."'   
												AND mulai_banner <= '".$timeHariIni."')
											AND (limit_banner > jumlah_show)
											AND tgl_show = '".$timeHariIni."'   
											ORDER BY rand() 
											LIMIT 2
											
											";
										
										
										$hslBanKiri = mysql_query($sqlBanKiri);
										$iJoin = 0;
										$arrJoin = array();
										while($brsBanKiri = mysql_fetch_array($hslBanKiri)) {
											$link = "";
											if (trim($brsBanKiri['link_banner'])=="loadJoin()") {
												$link = 'onclick=loadJoin()';
												$arrJoin[$iJoin]['tipe'] = $brsBanKiri['tipe'];
												$arrJoin[$iJoin]['id'] = $brsBanKiri[banner_id];
												$arrJoin[$iJoin]['file'] = $brsBanKiri[file_banner];
												$iJoin++;
												continue;
											} else {
												$link = 'onclick=window.open("klik_banner.php?id='.$brsBanKiri[banner_id].'");';
											}
											if($brsBanKiri['tipe'] == 'application/x-shockwave-flash'  ) {
												$arrSwf = getimagesize("images/banner/".$brsBanKiri['file_banner']);
												$swfH = $arrSwf[1];
												$link = "";
												echo '
													<a '.$link.' >
														<embed name="flashfile" src="../images/banner/'.$brsBanKiri['file_banner'].'" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="215" height="'.$swfH.'">
													</a>';
											}else {												
												echo "<a ".$link." class='pointer'><img border='0' src='../images/banner/".$brsBanKiri['file_banner']."'></a>";
											}
											
											$cmdUpdateKiri = "UPDATE cni_banner SET 
												tgl_show = '".date("Y-m-d")."',
												jumlah_show = jumlah_show + 1 
												WHERE 	banner_id = '".$brsBanKiri[banner_id]."'";
												
											mysql_query($cmdUpdateKiri);		

											log_banner($brsBanKiri[banner_id]);	
											
											echo "<br><br>";
										}
										
										foreach($arrJoin as $value) {
											$link = 'onclick=loadJoin()';
											
											if($value['tipe'] == 'application/x-shockwave-flash'  ) {												
												$arrSwf = getimagesize("images/banner/".$value['file']);
												$swfH = $arrSwf[1];
												$link = "";
												echo '													
													<a '.$link.' >
														<embed name="flashfile" src="../images/banner/'.$value['file'].'" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="215" height="'.$swfH.'">
													</a>';
											}else {												
												echo "<a ".$link." class='pointer'><img border='0' src='../images/banner/".$value['file']."'></a>";
											}
											
											$cmdUpdateKiri = "UPDATE cni_banner SET 
												tgl_show = '".date("Y-m-d")."',
												jumlah_show = jumlah_show + 1 
												WHERE 	banner_id = '".$value['id']."'";
												
											mysql_query($cmdUpdateKiri);		

											log_banner($value['id']);	
											
											echo "<br><br>";
										}
									?>
								</td>
							</tr>
							<tr>
								<td>
									<div id="chatMenu" align="left">
										<div align="center"><span class="hijau f-georgia f-20">Chat on JogjaStreamers</span><br/><span class="putih f-georgia f-18" id="chatDJ"></span></div><br/>
										<div id="chatIsi" class="inputPesan"></div>
										<form id="ajaxChatForm" method="POST" action="chat.php">
											<label class="f-11 putih" style="width:40px;float:left;">Nama:</label><input style="float:left;" type="text" size="8" name="dari" <?=$dari_readonly?> value="<?=$dari?>" class="inputPesan"/> (max 15 char.)<br style="clear:both"/>
											<label class="f-11 putih" style="width:40px;float:left;">Pesan:</label><input style="float:left;" type="text" name="pesan" <?=$pesan_readonly?> class="inputPesan"/><br style="clear:both"/>
											<input type="hidden" name="id" value="<?=$id?>"/>
											<input type="hidden" name="lid" value="0"/>
											<input type="submit" name="button" <?=$button_disabled?> value="Kirim" class="tombol"/>
										</form>
									</div>
									<br/>
								</td>
							</tr>
							<tr>
								<td valign="top" align="center">
									<div id="opini">
										<span class="hijau f-georgia f-20">Welcome to JogjaStreamers</span><br><br>
										<p class="abu f-georgia just"><?php echo ("$cuplikan");?>
										<br><a class="hijau pointer" onclick="loadWelcome('<?=$idwelcome?>');">more..</a></p>									
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<br><br>
									<span class="hijau f-georgia f-20">Berita Jogjastreamers</span><br>
									<ul class="markiri0 padkiri0">
									<?php
										while($rsMerapi2=mysql_fetch_assoc($resMerapi2)){
											echo "<li class='putih padlist'><a class='abu pointer' onclick=loadBeritaDetail('".$rsMerapi2[berita_id]."'); >".$rsMerapi2[judul_berita]."</a></li>";
										
										}
									
									?>
								</td>
							</tr>
						</table>
					</td>
		
