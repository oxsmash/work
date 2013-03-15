<?
ob_start();
session_start();
$judulHalaman="DAFTAR RADIO";

include("../inc/headerAdmin.php");

$act = $_GET['act'];
$status = $_GET['status'];
$id = $_GET['id'];
$katakunci = $_GET['katakunci'];
$PageNo = $_GET['PageNo'];
$cHidden = $_GET['cHidden'];
$Submit = $_GET['Submit'];

if($act=="hapus" && $id > 0)
	{
	$sqlU="Update radio set status='".$status."' where radio_id='".$id."'";
	//echo $sqlU;
	mysql_query($sqlU);
	}
	
if($act=="main" && $id > 0)
	{
	$sqlU="Update radio set status_tambahan='".$status."' where radio_id='".$id."'";
	//echo $sqlU;
	mysql_query($sqlU);
	}	
	

if($cHidden=="1")
	{
	$katakunci=trim($katakunci);	
	
	$arrKataKunci= explode(" ",$katakunci);  

	//echo count($arrKataKunci)."<br />";
	for($dd=0;$dd < count($arrKataKunci);$dd++)
		{
		$detQuery=$detQuery."(LCASE(nama) LIKE '%".strtolower($arrKataKunci[$dd])."%' or LCASE(ket_singkat) LIKE '%".strtolower($arrKataKunci[$dd])."%') AND ";		
		}
		
	$sqlview = "SELECT * FROM ".tabel_radio." where ". $detQuery ."ORDER BY radio_id DESC";
	$sqlview =str_replace("AND ORDER","ORDER",$sqlview);
	}
else
	{
	$sqlview = "SELECT * FROM radio ORDER BY radio_id DESC";
	}
	

//utk membuat otomatis bar halaman sesuai setting berita
$link=$PHP_SELF."";
$PageSize = 30;
include "../inc/barHalaman.php";
?>
	<!--sisi kanan mulai-->
	<br />
	&nbsp;&nbsp;<span class="judul_menu">Daftar Radio ::</span>
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
	<table border="0" cellspacing="1" cellpadding="3" width="100%" bgcolor="#BBBABA">
	<tr bgcolor="#BBBABA">
	   <td valign="top" align="center"><b>No</b></td>
	   <td valign="top" align="center"><b>Nama Radio</b></td>
		<td valign="top" align="center"><b>URL Barter</b></td> 
	   <td valign="top" align="center"><b>Status</b></td>
	   <td valign="top" align="center"><b>Under Maintenance</b></td>
	</tr>
	<?
	
	$result = mysql_query($sqlview);
	
	$k=0;
	$z=0;
	while($rs = mysql_fetch_array($result)) {
	$k=$k+1;
	$z=$k+(($PageNo - 1)*$PageSize);
	$bID = $rs['radio_id'];
	$bJudul = $rs['nama'];	
	?>
	<tr bgcolor="#FFFFFF" onMouseOver="this.style.background='#ebebeb'" onMouseOut="this.style.background='#ffffff'">
	   <td valign="middle" align="center"><?echo $z;?>.</td>
	   <td valign="middle"><a href="editRadio.php?act=edit&id=<?echo $bID?>"><?echo $bJudul;?></a></td>	   
		<td valign="top" align="center"> 
			<?			
			echo htmlentities(
				'<a target="_blank" href="http://'.$_SERVER['HTTP_HOST'].'/index.php?play='.$rs['radio_id'].'">Streaming</a>
			');
			?>			
		</td>
	   <td valign="top" align="center">
	   <?
	   if($rs['status']=="0")
	   {
	   	echo '<a href="listRadio.php?act=hapus&id='.$rs[radio_id].'&status=1&PageNo='.$PageNo.'"><img src="../images/on3.gif" alt="Active" border="0"></a>&nbsp;';
	   	echo '<img src="../images/off2.gif" border="0" alt="Set Inactive">';				   	
	   }
	   else
	   {
	   	echo '<img src="../images/on2.gif" alt="Active">&nbsp;';
	   	echo '<a href="listRadio.php?act=hapus&id='.$rs[radio_id].'&status=0&PageNo='.$PageNo.'"><img src="../images/off3.gif" border="0" alt="Set Inactive"></a>';
	   }
	   ?></td>
	   <td valign="top" align="center">
		<?
		   if($rs['status_tambahan']=="0")
		   {
		   	echo '<a href="listRadio.php?act=main&id='.$rs[radio_id].'&status=1&PageNo='.$PageNo.'"><img src="../images/main.gif" alt="Active" border="0"></a>';
		   			   	
		   }
		   else
		   {
		   	echo '<a href="listRadio.php?act=main&id='.$rs[radio_id].'&status=0&PageNo='.$PageNo.'"><img src="../images/main1.gif" border="0" alt="Set Inactive"></a>';
		   }
		?>
	   </td>
	</tr>
	<?
	}
	?>
	</table>
	<!--sisi kanan selesai-->
<?
include("../inc/footerAdmin.php");
?>
