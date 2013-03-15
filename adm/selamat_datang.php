<?php
include("../inc/headerAdmin.php");
?>
	<table height="80" width="100%">
	<tr>
	<td align="center"><h4> ADMIN AREA </h4><br />
	</td>
	</tr>
	<tr>
		<td>
			<? if($_SESSION['SessionNya']['id'] > 0 and $_SESSION['Login'] = "STUPPAhjklmnbv"){?>
			
					<table align="center" width="500" cellpadding="8" border="0">
						<tr>
							<td align="center" valign="top" id="usaha_home">
								<img src="../images/ikon_admin_1.jpg" onclick="ikon2('usaha_home');" class="pointer">
								<br> Setting Jenis Usaha
								<div class="hilang2">
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
							<td align="center" valign="top" id="kota_home"><img src="../images/ikon_admin_2.jpg" onclick="ikon2('kota_home');" class="pointer">
								<br> Setting Kota
								<div class="hilang2">
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
							<td align="center"  valign="top" id="radio_home"><img src="../images/ikon_admin_3.jpg" onclick="ikon2('radio_home');" class="pointer" >
								<br> Setting Profile Radio
								<div class="hilang2">
									<table cellpadding="5">
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
							<td align="center" valign="top" id="banner_home"><img src="../images/ikon_admin_4.jpg" onclick="ikon2('banner_home');" class="pointer">
								<br> Setting Banner
								<div class="hilang2">
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
							<td align="center" valign="top" id="berita_home"><img src="../images/ikon_admin_5.jpg" onclick="ikon2('berita_home');" class="pointer">
								<br> Setting Berita
								<div class="hilang2">
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
							<td align="center" valign="top" id="halaman_home"><img src="../images/ikon_admin_6.jpg" onclick="ikon2('halaman_home');" class="pointer">
								<br> Setting Halaman
								<div class="hilang2">
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
							<td align="center" valign="top" id="stat_home"><img src="../images/ikon_admin_7.jpg" onclick="ikon2('stat_home');" class="pointer">
								<br> Statistik & durasi
								<div class="hilang2">
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
							<td align="center" valign="top">
								<a href="gantiPassword.php" ><img src="../images/ikon_admin_8.jpg" class="pointer" border="0"></a>
								<a href="gantiPassword.php" ><br> Ganti Password</a>
							</td>
						</tr>
					</table>
					
			<?}?>
		</td>
	</tr>
	</table>
<?
include("../inc/footerAdmin.php");
?>
