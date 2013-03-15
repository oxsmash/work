<?php
//ob_start();
//session_start();

include_once("inc/config.php");
include_once("inc/fungsi.php");

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
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="Shortcut Icon" href="js.ico" type="image/x-icon" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/jquery.corner.js"></script>
<script type="text/javascript" src="js/center.js"></script>
<script type="text/javascript" src="js/radiojs_fb.js"></script>
<script type="text/javascript"> 
window.fbAsyncInit = function() {
FB.Canvas.setAutoResize( 100 );
}
// Do things that will sometimes call sizeChangeCallback()
function sizeChangeCallback() {
FB.Canvas.setSize({ width: 510, height: 2000 });
}
</script> 
</head> 
<body style="overflow:hidden; background: #ffffff;">
<table width="510" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000;">
	<tr>
		<td height="123" align="center" bgcolor="#363636">
			<table width="510" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table width="510" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="383"><img src="images/logojogjast.jpg"></td>
								<td width="111" style="background:url(images/logobg.jpg) repeat-x;" >
								&nbsp;
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
								<td width="60%" align="left">
									<table width="60%" height="10" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td align="center" class="grskanan"><a onclick="loadHome('fast');" class="abu f-11 pointer">HOME</a> &nbsp;</td>
											<td align="center" class="grskanan"><a class="abu f-11 pointer" onclick="loadAbout();">ABOUT US</a> </td>
											<td align="center" ><a class="abu f-11 pointer" onclick="loadBerita();">NEWS</a> </td>
										</tr>
									</table>
								</td>
								<td align="left" width="24%"  >&nbsp;
									<select name="slcity" id="slcity" class="f-12 combo" onchange="loadRadioList('' +this.options[this.selectedIndex].value + '',''+this.options[this.selectedIndex].text+'');">
										<option value="">Semua Kota</option>
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
			<table width="510" border="0" cellpadding="0" cellspacing="0" align="center" style="margin-top:15px;"  bgcolor="#000000;">
				<tr>
					
		
