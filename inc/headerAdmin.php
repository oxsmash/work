<?
ob_start();
session_start();
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/fungsi_khusus.php");
//if(basename($PHP_SELF)!="index.php")require("../inc/cekLogin.php");
if(!isset($_SESSION['SessionNya']['id'])) {
	header("location:index.php");
}


$cKode=utk5Digit(rand(1,32768));
$crypt = new MD5Crypt;
$hKode = $crypt->Encrypt($cKode,key_generator);

$titikFolder="../";



?>
<html>
<head>
<title>Admin Area</title>
<meta http-equiv="Content-Type" content="text/html; ">
<meta name="Author" content="CV Citraweb Nusa InfoMedia ---- Web designer: Anjung Sakti Mapayoga, Web programmer: Ronal Rivandy" />
<link href="style.css" type="text/css" rel="stylesheet">
<style type="text/css" rel="stylesheet">
@media print {
	#menu{display:none;}	
	#flash {display:block;width:100%;}
	#konten {display:block;width:100%;}
	.linkstat{display:none;}
	#foot{display:none;}
	#frm{display:none;}
	#lg1,#lg2,#lg3{display:none;}
	.judul_menu{display:none;}
	input{display:none;}
	table,td{border:0px solid #fff;background:#fff}
	.kotak{border:0px solid #fff;}
}

</style>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/skrp_adm.js"></script>

</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0" bgcolor="#BBBABA"> 

<table cellspacing="0" cellpadding="8" border="0" width="100%" bgcolor="#ffffff">
<tr>
	<td align="left" valign="middle" id="lg1"><IMG src="../images/logoStream.gif"></td>
	<td align="right" id="lg2">
		<table>
			<tr>
				<td align="center">
					<a href="selamat_datang.php"><img src="../images/home.jpg" border="0"> </a>
					<br> <a href="selamat_datang.php">Home</a>
				</td>
				<td><a href="logout.php"><img src="../images/logout.jpg" border="0"></a>
					<br> <a href="logout.php">Logout</a>
				</td>
			</tr>
		</table>		
	</td>
</tr>
<td class="kotak" colspan="2" align="left" valign="top" height="600" style="border-top:5px solid #BBBABA;">
	<table width="100%">
		<tr>
			<td width="20%" valign="top" id="menu">
				<? if($_SESSION['SessionNya']['id'] > 0 and $_SESSION['Login'] = "STUPPAhjklmnbv"){?>
				<table cellspacing="0" cellpadding="2" border="0" width="90%" id="menu">
					<tr>
						<td width="10%"><img src="../images/usaha_kecil.jpg" class="pointer" onclick="ikon('usaha');"></td>	
						<td align="left" class="pointer" onclick="ikon('usaha');" valign="middle" style="border-bottom:1px solid #BBBABA;border-right:1px solid #BBBABA">Setting Usaha
						
						</td>
					</tr>
					<tr>
						<td></td>
						<td id="usaha" valign="top">
							<div class="hilang" >
								<table cellpadding="5">
									<tr>
										<td><a href="listJenisUsaha.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listJenisUsaha.php" >Daftar Jenis Usaha</a></td>
									</tr>
									<tr>
										<td><a href="addJenisUsaha.php"><img src="../images/add.gif" border='0'></a></td>
										<td><a href="addJenisUsaha.php">Tambah Jenis Usaha</a></td>
									</tr>
								</table>	
								
							</div>
						</td>
					</tr>
					<tr>
						<td width="10%"><img src="../images/kota_kecil.jpg" onclick="ikon('kota');" class="pointer"></td>	
						<td align="left" onclick="ikon('kota');" class="pointer" valign="middle" style="border-bottom:1px solid #BBBABA;border-right:1px solid #BBBABA">Setting Kota</td>
					</tr>
					<tr>
						<td></td>
						<td id="kota" valign="top" >
							<div class="hilang">
								<table cellpadding="5">
									<tr>
										<td><a href="listKota.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listKota.php" >Daftar Kota</a></td>
									</tr>
									<tr>
										<td><a href="addKota.php" ><img src="../images/add.gif" border='0'></a></td>
										<td><a href="addKota.php" >Tambah Kota</a></td>
									</tr>
								</table>	
							
							</div>
						</td>
					</tr>
					<tr>
						<td width="10%"><img src="../images/radio_kecil.jpg"  onclick="ikon('radio');" class="pointer" ></td>	
						<td align="left" onclick="ikon('radio');" class="pointer"  valign="middle" style="border-bottom:1px solid #BBBABA;border-right:1px solid #BBBABA">Setting Profile Radio</td>
					</tr>
					<tr>
						<td></td>
						<td id="radio" valign="top">
							<div class="hilang">
								<table cellpadding="5">
									<tr>
										<td><a href="listServer.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listServer.php" >Daftar Server Radio</a></td>
									</tr>
									<tr>
										<td><a href="addServer.php" ><img src="../images/add.gif" border='0'></a></td>
										<td><a href="addServer.php" >Tambah Server Radio</a></td>
									</tr>
									<tr>
										<td><a href="listRadio.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listRadio.php" >Daftar Radio</a></td>
									</tr>
									<tr>
										<td><a href="addRadio.php" ><img src="../images/add.gif" border='0'></a></td>
										<td><a href="addRadio.php" >Tambah Radio</a></td>
									</tr>
									<tr>
										<td><a href="listPenyiar.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listPenyiar.php" >Daftar Penyiar</a></td>
									</tr>
									<tr>
										<td><a href="addPenyiar.php" ><img src="../images/add.gif" border='0'></a></td>
										<td><a href="addPenyiar.php" >Tambah Penyiar</a></td>
									</tr>
								</table>	
							</div>
						</td>
					</tr>
					<tr>
						<td width="10%"><img src="../images/ad_kecil.jpg"  onclick="ikon('banner');" class="pointer"></td>	
						<td align="left" valign="middle"  onclick="ikon('banner');" class="pointer" style="border-bottom:1px solid #BBBABA;border-right:1px solid #BBBABA">Setting Banner</td>
					</tr>
					<tr>
						<td></td>
						<td id="banner" valign="top">
							<div class="hilang">
								<table cellpadding="5">
									<tr>
										<td><a href="listBanner.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listBanner.php" >Daftar Banner</a></td>
									</tr>
									<tr>
										<td><a href="addBanner.php" ><img src="../images/add.gif" border='0'></a></td>
										<td><a href="addBanner.php" >Tambah Banner</a></td>
									</tr>
								</table>	
								
							</div>
						</td>
					</tr>
					<tr>
						<td width="10%"><img src="../images/berita_kecil.jpg"  onclick="ikon('berita');" class="pointer"></td>	
						<td align="left" onclick="ikon('berita');" class="pointer" valign="middle" style="border-bottom:1px solid #BBBABA;border-right:1px solid #BBBABA">Setting Berita</td>
					</tr>
					<tr>
						<td></td>
						<td id="berita" valign="top">
							<div class="hilang">
								<table cellpadding="5">
									<tr>
										<td><a href="listBerita.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listBerita.php" >Daftar Berita</a></td>
									</tr>
									<tr>
										<td><a href="addBerita.php" ><img src="../images/add.gif" border='0'></a></td>
										<td><a href="addBerita.php" >Tambah Berita</a></td>
									</tr>
								</table>	
									
							</div>
						</td>
					</tr>
					<tr>
						<td width="10%"><img src="../images/halaman_kecil.jpg"  onclick="ikon('halaman');" class="pointer"></td>	
						<td align="left" valign="middle" onclick="ikon('halaman');" class="pointer" style="border-bottom:1px solid #BBBABA;border-right:1px solid #BBBABA">Setting Halaman</td>
					</tr>
					<tr>
						<td></td>
						<td id="halaman" valign="top">
							<div class="hilang">
								<table cellpadding="5">
									<tr>
										<td><a href="editAbout.php?act=edit" ><img src="../images/edit.gif" border='0'></a></td>
										<td><a href="editAbout.php?act=edit" >Edit About Us</a></td>
									</tr>
									<tr>
										<td><a href="editWelcome.php?act=edit" ><img src="../images/edit.gif" border='0'></a></td>
										<td><a href="editWelcome.php?act=edit" >Edit welcome</a></td>
									</tr>
									<tr>
										<td><a href="editAdvertisement.php?act=edit" ><img src="../images/edit.gif" border='0'></a></td>
										<td><a href="editAdvertisement.php?act=edit" >Edit Advertisement</a></td>
									</tr>
									<tr>
										<td><a href="editTerms.php?act=edit" ><img src="../images/edit.gif" border='0'></a></td>
										<td><a href="editTerms.php?act=edit" >Edit Terms & Condition</a></td>
									</tr>
								</table>	
									
							</div>
						</td>
					</tr>
					<tr>
						<td width="10%"><img src="../images/stat_kecil.jpg"  onclick="ikon('stat');" class="pointer" ></td>	
						<td align="left" valign="middle" onclick="ikon('stat');" class="pointer" style="border-bottom:1px solid #BBBABA;border-right:1px solid #BBBABA">Statistik & Durasi</td>
					</tr>
					<tr>
						<td></td>
						<td id="stat" valign="top">
							<div class="hilang">
								<table cellpadding="5">
									<tr>
										<td><a href="test_grafik.php" ><img src="../images/stat.jpg" border='0'></a></td>
										<td><a href="test_grafik.php" >Statistik Radio</a></td>
									</tr>
									<tr>
										<td><a href="listStat3.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listStat3.php" >Daftar Log Radio</a></td>
									</tr>
									<tr>
										<td><a href="listStatWaktu.php" ><img src="../images/stat.jpg" border='0'></a></td>
										<td><a href="listStatWaktu.php" >Statistik Durasi Radio</a></td>
									</tr>
									<tr>
										<td><a href="listLogDurasi.php" ><img src="../images/list.gif" border='0'></a></td>
										<td><a href="listLogDurasi.php" >Log Durasi Radio</a></td>
									</tr>
								</table>	
									
									
							</div>
						</td>
					</tr>
					<tr>
						<td width="10%"><a href="gantiPassword.php"><img src="../images/password_kecil.jpg"  class="pointer" border="0"></a></td>	
						<td align="left" valign="middle" style="border-bottom:1px solid #BBBABA;border-right:1px solid #BBBABA"><a href="gantiPassword.php">Ganti Password</a></td>
					</tr>
				</table>	
				<?}?>
			</td>
			<td valign="top" id="konten">

	