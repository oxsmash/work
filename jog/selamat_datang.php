<?php
include("../inc/headerLog.php");
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
