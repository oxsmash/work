<?php
	$ipType = 2;
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.corner.js"></script>
<script type="text/javascript" src="js/JavaScriptFlashGateway.js"></script>
<script type="text/javascript" src="js/radiojs.js"></script>
</head>
<body >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="105" align="center" bgcolor="#545454">
			<?php
				$sqlHeader = "SELECT * FROM ".tabel_banner." WHERE status_banner = '1' AND letak_banner = '1' LIMIT 1 ";
	
				$hsl2 = mysql_query($sqlHeader);
				while($brsHeader = mysql_fetch_array($hsl2)) {
					if($brsHeader['tipe'] == 'application/x-shockwave-flash'  ) {
						echo '
							<a href="klik_banner.php?id='.$brsHeader[banner_id].'" target="_blank" >
								<embed class="pointer" name="flashfile" src="images/banner/'.$brsHeader['file_banner'].'" wmode="transparent" menu="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="673" height="94">
								</embed>
							</a>';
					
					}else {
						
						echo "<a onclick=window.open('klik_banner.php?id=".$brsHeader[banner_id]."'); class='pointer'><img border='0' src='images/banner/".$brsHeader['file_banner']."'></a>";
						
					}
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
								<td width="383"><img src="images/logojogjast.jpg"></td>
								<td width="477" style="background:url(images/logobg.jpg) repeat-x;" >
									<table width="80%" align="center" cellspacing="1" cellpadding="0" border="0" >
										<tr>
											<td><img src="images/about.gif"></td>
											<td><img src="images/what.gif"></td>
											<td align="left"><img src="images/news.gif"></td>
										</tr>
										<tr>
											<td><a onclick="loadAbout();" class="hitam pointer"><b>ABOUT US</b><a></td>
											<td><a onclick="loadBerita('','');" class="hitam pointer"><b>NEWS</b><a></td>
											<td><a onclick="loadContact();" align="left" class="hitam pointer"><b>CONTACT US</b><a></td>
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
									<div id="ip" style="color:black;"><?php echo $ipType; ?></div>
									<div id="xswf">&nbsp;</div>
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
		