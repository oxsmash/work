<?
ob_start();
session_start();
include("inc/fungsi.php");
include("inc/config.php");
?>
<HTML>
<HEAD><TITLE>JOGJA STREAMERS</TITLE></HEAD>
<link rel="stylesheet" type="text/css" href="inc/style.css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<body bgcolor="898989" background="images/background.gif" topmargin="0" bottommargin="0" style="background-position:top; background-repeat:repeat-x;">
<center>
<table cellpadding="0" cellspacing="0" border="0" valign="top">

<tr>
<td valign="top" width="775" height="552">
	<table cellpadding="0" cellspacing="0" border="0" bgcolor="ebebeb">
	<tr><!--header-->
		<td>
			<table cellpadding="0" cellspacing="0" border="0" >
			<tr>
			<td valign="top"><img src="images/bd_kiri_top.gif"></td>
			<td><img src="images/head1.gif"><img src="images/head2.gif"><img src="images/head3.gif"><img src="images/head4.gif"><img src="images/head5.gif"></td>
			<td valign="top"><img src="images/bd_knn_top.gif"></td>
			</tr>
			<tr>
			<td background="images/bd_kiri_tengah1.gif"><img src="images/bd_kiri_tengah1.gif"></td>
			<td>
				<table cellpadding="0" cellspacing="0" border="0"><tr>
				<td width=55 height=13 align=center><img src="images/anim_home.gif" name="Image11"></td>
				<td width=62 height=13 align=center><img src="images/anim_about.gif" name="Image2"></td>
				<td width=92 height=13 align=center><img src="images/anim_radio.gif" name="Image3"></td>
				<td width=69 height=13 align=center><img src="images/anim_straming.gif" name="Image4"></td>
				<td width=68 height=13 align=right><img src="images/anim_contact.gif" name="Image5"></td>
				<td><img src="images/head2-1.gif"><img src="images/head2-2.gif"><img src="images/head2-3.gif"><img src="images/head2-4.gif"></td>
				</tr></table>
			</td>
			<td background="images/bd_knn_tengah1.gif"><img src="images/bd_knn_tengah1.gif"></td>
			</tr>
			<tr>
			<td background="images/bd_kiri_tengah2.gif"><img src="images/spacer.gif"></td>
			<td height=4><img src="images/thome.gif"><img src="images/tabout.gif"><img src="images/tradio.gif"><img src="images/tstream.gif"><img src="images/tcontact.gif"><img src="images/t.gif"></td>
			<td background="images/bd_knn_tengah2.gif"><img src="images/spacer.gif"></td>
			</tr>
			<tr>
			<td background="images/bd_kiri_tengah2.gif"><img src="images/spacer.gif"></td>
			<td>
				<table cellpadding="0" cellspacing="0" border="0"><tr>
				<td width=55 height=13 align=center><a href="index.php" class="merah" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image11','','images/ud_home.gif',1)">Home</a></td>
				<td width=62 height=13 align=center><a href="about.php" class="merah" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','images/ud_aboutus.gif',1)">About Us</a></td>
				<td width=92 height=13 align=center><a href="radioStation.php" class="merah" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','images/ud_radiostation.gif',1)">Radio Stations</a></td>
				<td width=69 height=13 align=center><a href="streaming.php" class="merah" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','images/ud_streaming.gif',1)">Streaming</a></td>
				<td width=66 height=13 align=right><a href="hubungiKami.php" class="merah" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image5','','images/ud_contactus.gif',1)">Contact Us</a></td>
				<td><img src="images/head3-1.gif"><img src="images/head3-2.gif"><img src="images/head3-3.gif"></td>
				<td class="tgl"><?=tglIndo(time(),"h");?></td>
				</tr></table>
			</td>
			<td background="images/bd_knn_tengah2.gif"><img src="images/spacer.gif"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td valign=top>
				<table cellpadding="0" cellspacing="0" border="0">
				<tr><!--Body-->
					<td background="images/bd_kiri_tengah.gif" valign=top><img src="images/bd_kiri_tengah3.gif"></td>				
					<td width=615 height=301 valign="top">
					<table cellpadding="0" cellspacing="0" border="0">
						<tr>
						<td width=170 height=291 valign=top><!--kiri-->
						<table width="160" cellpadding="0" cellspacing="0" border="0">
						<tr><td><img src="images/streaming-head.gif"></td></tr>
						<tr><td bgcolor="#ffffff" background="images/streaming-bg.gif" style="padding: 7px;">
							<?//include("listRadio.php");
							
							$r = mysql_query("select * from radio where status = '1' order by radio_id desc limit 10");
							while($d = mysql_fetch_assoc($r)) {
								echo '<a href="javascript:void(0)" onclick="window.open(\'play_radio.php?act=play&radio_id='.$d['radio_id'].'\', \'player\', \'width=273,height=223,toolbar=0,resizable=0,status=0,menubar=0,location=0\')">', strtoupper($d['nama']) ,'</a><br>';
							}
							?>
							
						</td></tr>
						<tr><td align=right background="images/streaming-bg.gif" style=" padding-right: 15px;">
							<a href="streaming.php" class="more2">more</a><br /><br />
							</td></tr>
							</tr><td align="left" background="images/streaming-bg.gif" style=" padding-left: 10px; padding-right: 15px">
							<a href="http://202.65.113.30/nas/wmpfirefoxplugin.exe">WMP Plugin for Firefox</a><br /><br />
							<a href="http://202.65.113.30/nas/mp3PROAudioDecoder.exe">MP3Pro Plugin for WinAmp</a><br />
							</td></tr>
						<tr><td><img src="images/streaming-foot.gif"></td></tr>
						</table>
						</td>	
						<td style="padding-left: 3px;" valign="top" width="430">							
