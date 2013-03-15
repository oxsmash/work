<?
ob_start();
session_start();
$judulHalaman="DAFTAR BANNER";
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
$letakBanner = $_GET['letakBanner'];

if($act=="hapus" && $id > 0)
	{
	$sqlU="Update ".tabel_banner." set status_banner='".$status."' where banner_id='".$id."'";
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
		$detQuery=$detQuery."(nama_banner LIKE '%".$arrKataKunci[$dd]."%' or link_banner LIKE '%".$arrKataKunci[$dd]."%') AND ";
		}
	
	if($letakBanner > 0) 
		{
		$detQuery=$detQuery."(letak_banner = '".$letakBanner."') AND ";
		}
	
	$sqlview = "SELECT * FROM ".tabel_banner." where ". $detQuery ."ORDER BY banner_id DESC";
	$sqlview =str_replace("AND ORDER","ORDER",$sqlview);
	}
else
	{
	$sqlview = "SELECT * FROM ".tabel_banner." ORDER BY banner_id DESC";
	}


//utk membuat otomatis bar halaman sesuai setting banner
$link=$PHP_SELF."?";
$PageSize = 10;
include "../inc/barHalaman.php";
?>
				<!--sisi kanan mulai-->
				<br />
				&nbsp;&nbsp;<span class="judul_menu">Daftar Banner ::</span>
				<br />
				<br />
<form action="<?=$PHP_SELF;?>" method="get">
<table cellpadding="0" cellspacing="0" border="0">
<tr><td>Kata Kunci</td><td>:</td><td><input type="text" name="katakunci" value="<?=$katakunci?>">
	<select name="letakBanner" class="inputPesan">
	<option value="0" <?=($letakBanner == "0") ? "selected" : "" ?>>Semua</option>
	<option value="1" <?=($letakBanner == "1") ? "selected" : "" ?>>Atas</option>
	<option value="2" <?=($letakBanner == "2") ? "selected" : "" ?>>Bawah</option>
	<option value="3" <?=($letakBanner == "3") ? "selected" : "" ?>>Kanan</option>
	<option value="4" <?=($letakBanner == "4") ? "selected" : "" ?>>Kiri</option>
	<option value="5" <?=($letakBanner == "5") ? "selected" : "" ?>>Splash</option>
	<option value="6" <?=($letakBanner == "6") ? "selected" : "" ?>>Running teks</option>
	<option value="7" <?=($letakBanner == "7") ? "selected" : "" ?>>Audio</option>
	</select>
<input type="hidden" name="cHidden" value="1">
<input type="submit" name="cSubmit" value="Cari" class="tombol"></td></tr>
</table>
</form>
<?
if(strlen($katakunci) > 0) echo "Hasil pencarian dengan kata kunci \"<b>".$katakunci."\"</b><br />Ada <b>".$RecordCount."</b> data yang ditampilkan dalam <b>".$MaxPage."</b> halaman.";
?>
				<?echo $bar;?>
				<br />
				+ <a href="addBanner.php">Tambah Banner</a> +
				<table border=0 cellspacing=0 cellpadding=0 width=100%><td bgcolor="#BBBABA">
				<table border=0 cellspacing=1 cellpadding=3 width=100%>
				<tr bgcolor="#DCDCDC">
				   <td valign=top align=center><b>No</b></td>
				   <td valign=top align=center><b>Nama Banner</b></td>
				   <td valign=top align=center><b>Letak Banner</b></td>
				   <td valign=top align=center><b>Link</b></td>				 
				   <td valign=top align=center><b>Tanggal</b></td>
				   <td valign=top align=center><b>Limit/day</b></td>
				   <td valign=top align=center><b>Jumlah Show</b></td>
				   <td valign=top align=center><b>Status</b></td>
				</tr>
				<?
				$result = mysql_query($sqlview);
				$k=0;
				$z=0;
				while($rs = mysql_fetch_array($result)) {
				$k=$k+1;
				$z=$k+(($PageNo - 1)*$PageSize);
				$bID = $rs[banner_id];
				$bJudul = $rs[nama_banner];
				$bLink=$rs[link_banner];
				$bLimit=$rs[limit_banner];
				$bLetak=$rs[letak_banner];
				$bJml=$rs[jumlah_show];
				
				$arrLetak = array(
						'1' => 'Atas',
						'2' => 'Bawah',
						'3' => 'Kanan',
						'4' => 'Kiri',
						'5' => 'Splash',
						'6' => 'Running Teks',
						'7' => 'Audio',
				);
				
				
				?>
				<tr bgcolor="#FFFFFF" onMouseOver="this.style.background='#ebebeb'" onMouseOut="this.style.background='#FFFFFF'">
				   <td valign=middle align=center><?echo $z;?>.</td>
				   <td valign=middle><a href="editBanner.php?act=edit&id=<?echo $bID?>"><?echo $bJudul;?></a></td>
				   <td valign=middle><? echo $arrLetak[$bLetak];?></td>
				   <td valign=middle><? echo $bLink;?></td>
				   <td valign=middle><?echo TglIndo($rs[mulai_banner],"s") ." s/d ". TglIndo($rs[selesai_banner],"s");?></td>
				   <td valign=middle align=right><?echo $bLimit;?></td>
				   <td valign=middle align=right><?echo $bJml;?></td>
				   <td valign=top align=center>
				   <?
				   if($rs[status_banner]=="0")
				   {
				   	echo '<a href="listBanner.php?act=hapus&id='.$rs[banner_id].'&status=1"><img src="../images/status_1_b.gif" alt="Active" border="0"></a>&nbsp;';
				   	echo '<img src="../images/status_0_b.gif" border="0" alt="Set Inactive">';
				   }
				   else
				   {
				   	echo '<img src="../images/status_1.gif" alt="Active">&nbsp;';
				   	echo '<a href="listBanner.php?act=hapus&id='.$rs[banner_id].'&status=0"><img src="../images/status_0.gif" border="0" alt="Set Inactive"></a>';
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
