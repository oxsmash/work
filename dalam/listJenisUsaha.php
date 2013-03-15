<?php

ob_start();
session_start();
$judulHalaman="DAFTAR JENIS USAHA";
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
	$sqlU="Update ".tabel_jenis_usaha." set status='".$status."' where id_ju='".$id."'";
	//echo $sqlU;
	mysql_query($sqlU);
	}

if($cHidden=="1"){
	$katakunci=trim($katakunci);

	$arrKataKunci= explode(" ",$katakunci);

	//echo count($arrKataKunci)."<br />";
	for($dd=0;$dd < count($arrKataKunci);$dd++){
		$detQuery=$detQuery."(jenis_usaha LIKE '%".$arrKataKunci[$dd]."%' )";
	
		
	}
	
	$sqlview = "SELECT * FROM ".tabel_jenis_usaha." where ". $detQuery ."ORDER BY id_ju DESC";
	$sqlview =str_replace("AND ORDER","ORDER",$sqlview);
	
}else{
		$sqlview = "SELECT * FROM ".tabel_jenis_usaha." ORDER BY id_ju DESC";
}


//utk membuat otomatis bar halaman sesuai setting banner
$link=$PHP_SELF."?";
$PageSize = 10;
include "../inc/barHalaman.php";
?>
				&nbsp;&nbsp;<span class="judul_menu">Daftar Jenis Usaha ::</span>
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
				   <td valign=top align=center><b>Nama Jenis Usaha</b></td>
				   <td valign=top align=center width="5%"><b>Status</b></td>
				</tr>
				<?
				$result = mysql_query($sqlview);
				$k=0;
				$z=0;
				while($rs = mysql_fetch_array($result)) {
				$k=$k+1;
				$z=$k+(($PageNo - 1)*$PageSize);
				$kID = $rs[id_ju];
				$kJu = $rs[jenis_usaha];
				
				?>
				<tr bgcolor="#FFFFFF" onMouseOver="this.style.background='#ebebeb'" onMouseOut="this.style.background='#FFFFFF'">
				   <td valign=middle align=center><?echo $z;?>.</td>
				   <td valign=middle><a href="editJenisUsaha.php?act=edit&id=<?echo $kID?>"><?echo $kJu;?></a></td>
				   
				   <td valign=top align=center>
				   <?
				   if($rs[status]=="0")
				   {
				   	echo '<a href="listJenisUsaha.php?act=hapus&id='.$rs[id_ju].'&status=1&PageNo='.$PageNo.'"><img src="../images/on3.gif" alt="Active" border="0"></a>&nbsp;';
				   	echo '<img src="../images/off2.gif" border="0" alt="Set Inactive">';
				   }
				   else
				   {
				   	echo '<img src="../images/on2.gif" alt="Active">&nbsp;';
				   	echo '<a href="listJenisUsaha.php?act=hapus&id='.$rs[id_ju].'&status=0&PageNo='.$PageNo.'"><img src="../images/off3.gif" border="0" alt="Set Inactive"></a>';
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