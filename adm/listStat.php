<?php

ob_start();
session_start();
$judulHalaman="DAFTAR KOTA";
$fileIndex="";
$fileSearch="";


include("../inc/headerAdmin.php");


if($cHidden=="1"){
	$katakunci=trim($katakunci);

	$arrKataKunci= explode(" ",$katakunci);

	//echo count($arrKataKunci)."<br />";
	for($dd=0;$dd < count($arrKataKunci);$dd++){
		$detQuery=$detQuery."(nama LIKE '%".$arrKataKunci[$dd]."%' )";
	
		
	}
	
	
	$sqlview = "SELECT radio_id,nama FROM ".tabel_radio." a where ". $detQuery ."  ORDER BY radio_id DESC ";
	
}else{
			
		$sqlview = "SELECT radio_id,nama FROM ".tabel_radio." a ORDER BY radio_id DESC ";
		
				
}


//utk membuat otomatis bar halaman sesuai setting banner
$link=$PHP_SELF."?";
$PageSize = 15;
include "../inc/barHalaman.php";
?>
				&nbsp;&nbsp;<span class="judul_menu">Daftar Statistik ::</span>
	<br />
	<br />
	<form action="<?=$PHP_SELF;?>" method="get">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr><td>Kata Kunci</td><td>:</td><td><input type="text" name="katakunci" value="<?=$katakunci?>" class="inputPesan"> 
	<input type="hidden" name="cHidden" value="1"> 
	<input type="submit" name="cSubmit" value="Cari" class="tombol"></td></tr>
	</table>
	</form>
	<? 
	if(strlen($katakunci) > 0) echo "Hasil pencarian dengan kata kunci \"<b>".$katakunci."\"</b><br />Ada <b>".$RecordCount."</b> data yang ditampilkan dalam <b>".$MaxPage."</b> halaman.";
	?>								
	<?echo $bar; ?>

				<br /><br />
				
				
				<table border="0" cellspacing="1" cellpadding="3" width="100%" bgcolor="#BBBABA">
	<tr bgcolor="#BBBABA">
				   <td valign=top align=center width="5%"><b>No</b></td>
				   <td valign=top align=center ><b>Nama Radio</b></td>
				   <td valign=top align=center width="15%"><b>Jumlah Klik</b></td>
				</tr>
				<?
				$result = mysql_query($sqlview);
				$k=0;
				$z=0;
				while($rs = mysql_fetch_array($result)) {
				$k=$k+1;
				$z=$k+(($PageNo - 1)*$PageSize);
				$kID = $rs[radio_id];
				
				$kNama = $rs[nama];
				
				?>
				<tr bgcolor="#FFFFFF" onMouseOver="this.style.background='#ebebeb'" onMouseOut="this.style.background='#FFFFFF'">
				   <td valign=middle align=center><?echo $z;?>.</td>
				   <td valign=middle><?echo $kNama;?></td>
				   
				 
				   <td valign=top align=left>
						<?php
							$cmd21 = "SELECT COUNT(id_radio) As JML FROM ".tabel_stat." WHERE id_radio = '".$kID."' ";
							
							//echo $cmd21;
							
							$res21 = mysql_query($cmd21) or die();
							
							$hsl = mysql_fetch_array($res21);
						
							echo $hsl['JML'];
						
						?>
				   
				   </td>
				</tr>
				<?
				}
				?>
				</table>
				</td></table>
				<!--sisi kanan selesai-->






<?
include("../inc/footerAdmin.php");
?>