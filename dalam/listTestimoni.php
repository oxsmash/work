<?php

ob_start();
session_start();
$judulHalaman="DAFTAR Testimoni";
$fileIndex="";
$fileSearch="";


include("../inc/headerAdmin.php");

$act = $_GET['act'];
$cHidden = $_GET['cHidden'];
$katakunci = $_GET['katakunci'];
$PageNo = $_GET['PageNo'];
$id = $_GET['id'];
$status = $_GET['status'];
$Submit = $_GET['Submit'];


if($act=="hapus" && $id > 0){
	$sqlU="Update ".tabel_saksi." set status_kesaksian='".$status."' where kesaksian_id='".$id."'";
	echo $sqlU;
	mysql_query($sqlU);
	}

if($cHidden=="1"){
	$katakunci=trim($katakunci);

	$arrKataKunci= explode(" ",$katakunci);

	//echo count($arrKataKunci)."<br />";
	for($dd=0;$dd < count($arrKataKunci);$dd++){
		$detQuery=$detQuery."(nama LIKE '%".$arrKataKunci[$dd]."%' )";
	
		
	}
	
	$sqlview = "SELECT * FROM ".tabel_saksi." where ". $detQuery ."ORDER BY kesaksian_id DESC";
	$sqlview =str_replace("AND ORDER","ORDER",$sqlview);
	
}else{
		$sqlview = "SELECT * FROM ".tabel_saksi." ORDER BY kesaksian_id DESC";
}


//utk membuat otomatis bar halaman sesuai setting banner
$link=$PHP_SELF."?";
$PageSize = 10;
include "../inc/barHalaman.php";
?>
				&nbsp;&nbsp;<span class="judul_menu">Daftar Kesaksian ::</span>
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
				   <td valign=top align=center><b>Nama </b></td>
				   <td valign=top align=center><b>Isi </b></td>
				   <td valign=top align=center width="5%"><b>Status</b></td>
				</tr>
				<?
				$result = mysql_query($sqlview);
				$k=0;
				$z=0;
				while($rs = mysql_fetch_array($result)) {
				$k=$k+1;
				$z=$k+(($PageNo - 1)*$PageSize);
				$kID = $rs[kesaksian_id];
				$nama = $rs[nama];
				$isi = $rs[isi];
				
				?>
				<tr bgcolor="#FFFFFF" onMouseOver="this.style.background='#ebebeb'" onMouseOut="this.style.background='#FFFFFF'">
				   <td valign=middle align=center><?echo $z;?>.</td>
				   <td valign=middle width="15%"><?echo $nama;?></td>
				   <td valign=middle width="50%"><?echo $isi;?></td>
				   <td valign=top align=center>
				   <?
				   if($rs[status_kesaksian]=="0")
				   {
				   	echo '<a href="listTestimoni.php?act=hapus&id='.$rs[kesaksian_id].'&status=1"><img src="../images/status_1_b.gif" alt="Active" border="0"></a>&nbsp;';
				   	echo '<img src="../images/status_0_b.gif" border="0" alt="Set Inactive">';
				   }
				   else
				   {
				   	echo '<img src="../images/status_1.gif" alt="Active">&nbsp;';
				   	echo '<a href="listTestimoni.php?act=hapus&id='.$rs[kesaksian_id].'&status=0"><img src="../images/status_0.gif" border="0" alt="Set Inactive"></a>';
				   }
				   ?></td>
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