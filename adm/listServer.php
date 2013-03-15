<?php

ob_start();
session_start();
$judulHalaman="DAFTAR KOTA";
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
	$sqlU="delete from ".tabel_url." where id='".$id."'";
	//echo $sqlU;
	mysql_query($sqlU);
	}

if($cHidden=="1"){
	$katakunci=trim($katakunci);

	$arrKataKunci= explode(" ",$katakunci);

	//echo count($arrKataKunci)."<br />";
	for($dd=0;$dd < count($arrKataKunci);$dd++){
		$detQuery=$detQuery."(url LIKE '%".$arrKataKunci[$dd]."%' OR area LIKE '%".$arrKataKunci[$dd]."%' )";
	
		
	}
	
	$sqlview = "SELECT * FROM ".tabel_url." where ". $detQuery ."ORDER BY id DESC";
	$sqlview =str_replace("AND ORDER","ORDER",$sqlview);
	
}else{
		$sqlview = "SELECT * FROM ".tabel_url." ORDER BY id DESC";
}


//utk membuat otomatis bar halaman sesuai setting banner
$link=$PHP_SELF."?";
$PageSize = 10;
include "../inc/barHalaman.php";
?>
	<script type="text/javascript">
		function cek(id) {
			if(confirm("are you sure you want to delete it!") === true ) {
				window.location.href = 'listServer.php?act=hapus&id='+id;
			}
		}
	</script>
				&nbsp;&nbsp;<span class="judul_menu">Daftar Server ::</span>
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
				   <td valign=top align=center width="30%"><b>Area</b></td>
				   <td valign=top align=center width="65%"><b>Url</b></td>
				   <td>Aksi</td>
				</tr>
				<?
				$result = mysql_query($sqlview);
				$k=0;
				$z=0;
				while($rs = mysql_fetch_array($result)) {
				$k=$k+1;
				$z=$k+(($PageNo - 1)*$PageSize);
				$kID = $rs[id];
				$kArea = $rs[area];
				$kUrl = $rs[url];
				
				?>
				<tr bgcolor="#FFFFFF" onMouseOver="this.style.background='#ebebeb'" onMouseOut="this.style.background='#FFFFFF'">
				   <td valign=middle align=center><?echo $z;?>.</td>
				   <td ><a href="editServer.php?act=edit&id=<?echo $kID?>"><?echo $kArea;?></a></td>
				   <td><?echo $kUrl;?></td>
				   <td valign=top align=center>
				   <?
				  
				   	echo '<a onclick=cek("'.$kID.'"); >hapus</a>&nbsp;';
				   	
				   
				   
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